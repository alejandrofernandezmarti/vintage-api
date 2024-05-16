<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Omnipay\Omnipay;

class StripeController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }
    public function newOrder(Request $request){

       /*  $productosRequest = $request->productos;

        $productos = [];
        foreach ($productosRequest as $productoJson) {

            $productoArray = json_decode($productoJson, true);
            $productoId = $productoArray['id'];

            $producto = Producto::findOrFail($productoId);
            $producto->cantidad = $productoArray['cantidad'];

            $productos[] = [
                'producto' => $producto,
            ];
        }
        dd($productos);  */
        $productos = array_map('json_decode', $request->productos);
        $precios = $this->calculadoraPrecios($productos);
        $provincias = [
            "Álava",
            "Albacete",
            "Alicante",
            "Almería",
            "Asturias",
            "Ávila",
            "Badajoz",
            "Barcelona",
            "Burgos",
            "Cáceres",
            "Cádiz",
            "Cantabria",
            "Castellón",
            "Ceuta",
            "Ciudad Real",
            "Córdoba",
            "Cuenca",
            "Girona",
            "Las Palmas",
            "Granada",
            "Guadalajara",
            "Guipúzcoa",
            "Huelva",
            "Huesca",
            "Illes Balears",
            "Jaén",
            "A Coruña",
            "La Rioja",
            "León",
            "Lleida",
            "Lugo",
            "Madrid",
            "Málaga",
            "Melilla",
            "Murcia",
            "Navarra",
            "Ourense",
            "Palencia",
            "Pontevedra",
            "Salamanca",
            "Santa Cruz de Tenerife",
            "Segovia",
            "Sevilla",
            "Soria",
            "Tarragona",
            "Teruel",
            "Toledo",
            "Valencia",
            "Valladolid",
            "Vizcaya",
            "Zamora",
            "Zaragoza"
        ];
        return view('payment',compact('provincias','productos','precios'));
    }

    public function calculadoraPrecios($productos){
        $precioEnvio = 0;
        $precioCarrito = $this->calcularPrecioCarrito($productos);
        if ($precioCarrito >= 400) {
            $precioEnvio = 0;
        } else {
            foreach ($productos as $item) {
                $precioEnvio += $item->precio_env * ($item->cantidad / 10);
            }
            $precioEnvio = number_format($precioEnvio, 2);
        }
        $precioTotal = number_format($precioEnvio + $precioCarrito, 2);
        return [
            'precioProductos' => $precioCarrito,
            'precioEnvio' => $precioEnvio,
            'precioTotal' => $precioTotal
        ];
    }
    public function calcularPrecioCarrito($carrito)
    {
        $precioTotal = 0;
        foreach ($carrito as $item) {
            $precioTotal += $item->precio_ud * $item->cantidad;
        }
        return number_format($precioTotal, 2);
    }
    public function createOrder(Request $request)
    {


        if ($request->input('_token')){

            $gateway = Omnipay::create('Stripe');
            $gateway->setApiKey(env('STRIPE_SECRET'));

            $token = $request->input('_token');

            $response = $gateway->purchase([
                'amount' => Producto::whereIn('id', $request->ids)->sum('precio') /* sumar el envio*/,
                'currency' => 'EUR',
                'token' => $token
            ])->send();

            if ($response->isSuccessful()) {
                // payment was successful: insert transaction data into the database
                $arr_payment_data = $response->getData();

                $isPaymentExist = Payment::where('payment_id', $arr_payment_data['id'])->first();

               /*  if (!$isPaymentExist) {
                    $payment = new Payment;
                    $payment->payment_id = $arr_payment_data['id'];
                    $payment->payer_email = $request->email;
                    $payment->amount = $arr_payment_data['amount'] / 100;
                    $payment->currency = self::$STRIPE_CURRENCY;
                    $payment->payment_status = $arr_payment_data['status'];
                    $payment->save();
                }  */

                //ID PAGO: $arr_payment_data['id']

                //CREAR PEDIDO
                $order = new Order();
                $order->payment_id = $arr_payment_data['id'];
                $order->name = $request->name;
                $order->surnames = $request->surnames;
                $order->address = $request->address;
                $order->province = $request->province;
                $order->town = $request->town;
                $order->phone = $request->phone;
                $order->email = $request->email;
                $order->order_notes = $request->order_notes;
                $order->coupon = $descuento != null ? $descuento : null;
                $order->save();

                //CREAR LINEAS DEL PEDIDO
                $orders_lines = [];
                foreach (\Cart::getContent() as $pr){

                    $order_line = new OrderLines();
                    $order_line->order_id = $order->id;
                    $order_line->product_id = explode('-', $pr->id)[0];
                    $order_line->price = $pr->price;
                    $order_line->quantity = $pr->quantity;

                    //ATRIBUTOS
                    $order_line->tela1 = $pr->attributes->tela1;
                    $order_line->tela2 = $pr->attributes->tela2 == "null" ? null : $pr->attributes->tela2;
                    $order_line->sex = $pr->attributes->quantity;
                    $order_line->name = $pr->attributes->name == "null" ? null : $pr->attributes->name;

                    $order_line->save();
                    $aux['quantity'] = $pr->quantity;
                    $aux['name'] = $pr->name;
                    $aux['total'] = $pr->price * $pr->quantity;
                    array_push($orders_lines, $aux);
                }

                // ENVIAR CORREO DE CONFIRMACIÓN DE PEDIDO
                Mail::to($order->email)->send(new NewOrder($order, $orders_lines));

                if ($_SERVER['HTTP_HOST'] != 'repuntet.localhost') {
                    Mail::to('info@elrepuntet.es')->send(new NewOrderAdmin($order, $orders_lines));
                }

                \LaravelFacebookPixel::createEvent('PURCHASE', $parameters = []);


                \Cart::clear();
                return view("payments.payment_success", [
                    "order" => $order->id,
                ]);
            } else {
                // payment failed: display message to customer

                return view("payments.payment_success", [
                    "message" => $response->getMessage(),
                ]);
            }
        }
        return redirect('/404');
    }
}
