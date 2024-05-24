<?php

namespace App\Http\Controllers;

use App\Mail\MailContacto;
use App\Mail\NewOrder;
use App\Models\Compra;
use App\Models\Pago;
use App\Models\Producto;
use App\Models\ProductoCompra;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Omnipay\Omnipay;

class StripeController extends Controller
{
    public static $STRIPE_CURRENCY = "EUR";
    public function checkout()
    {
        return view('checkout');
    }
    public function newOrder(Request $request){
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


    public function calculadoraPrecios($productos)
    {
        $precioCarrito = (float)$this->calcularPrecioCarrito($productos);
        $precioEnvio = (float)$this->calcularEnvio($productos);
        $precioTotal = $precioEnvio + $precioCarrito;

        return [
            'precioProductos' => number_format($precioCarrito, 2, '.', ''),
            'precioEnvio' => number_format($precioEnvio, 2, '.', ''),
            'precioTotal' => number_format($precioTotal, 2, '.', '')
        ];
    }

    public function calcularEnvio($productos){
        $total = $this->calcularPrecioCarrito($productos);
        $precioEnvio = 0;
        if ($total >= 400){
            return 0;
        }else {
            foreach ($productos as $item) {
                $precio_env = Producto::find($item->id)->categoria->precio_env;
                $precioEnvio += $precio_env * ($item->cantidad / 10);
            }
            $precioEnvio = number_format($precioEnvio, 2, '.', '');
        }
        return $precioEnvio;
    }
    public function calcularPrecioCarrito($carrito)
    {
        $precioTotal = 0;

        foreach ($carrito as $item) {
            $precioUnitario = Producto::find($item->id)->precio_ud;
            $cantidad = $item->cantidad;
            if ($item->tipo == 'Box'){
                switch (true) {
                    case ($cantidad >= 100):
                        $precioUnitario *= 0.80; // 20% de descuento
                        break;
                    case ($cantidad >= 70):
                        $precioUnitario *= 0.84; // 16% de descuento
                        break;
                    case ($cantidad >= 50):
                        $precioUnitario *= 0.88; // 12% de descuento
                        break;
                    case ($cantidad >= 30):
                        $precioUnitario *= 0.92; // 8% de descuento
                        break;
                    case ($cantidad >= 20):
                        $precioUnitario *= 0.96; // 4% de descuento
                        break;
                    case ($cantidad <= 10):
                    default:
                        break;
                }
            }
            $precioUnitario = number_format($precioUnitario,2, '.', '');
            $precioTotal += $precioUnitario * $cantidad;
        }
        return number_format($precioTotal, 2, '.', '');
    }
    public function precioProducto($producto){
        $precioUnitario = Producto::find($producto->id)->precio_ud;
        $cantidad = $producto->cantidad;

        if ($producto->tipo == 'Box'){
            switch (true) {
                case ($cantidad >= 100):
                    $precioUnitario *= 0.80; // 20% de descuento
                    break;
                case ($cantidad >= 70):
                    $precioUnitario *= 0.84; // 16% de descuento
                    break;
                case ($cantidad >= 50):
                    $precioUnitario *= 0.88; // 12% de descuento
                    break;
                case ($cantidad >= 30):
                    $precioUnitario *= 0.92; // 8% de descuento
                    break;
                case ($cantidad >= 20):
                    $precioUnitario *= 0.96; // 4% de descuento
                    break;
                case ($cantidad <= 10):
                default:
                    break;
            }
        }
        return number_format($precioUnitario, 2, '.', '');
    }

    public function createOrder(Request $request)
    {

        if ($request->input('stripeToken')){

            $gateway = Omnipay::create('Stripe');
            $gateway->setApiKey(env('STRIPE_SECRET'));

            $token = $request->input('stripeToken');
            $productos = array_map('json_decode', $request->productos);
            $total = $this->calculadoraPrecios($productos);
            $response = $gateway->purchase([
                'amount' => $total['precioTotal'],
                'currency' => 'EUR',
                'token' => $token
            ])->send();

            if ($response->isSuccessful()) {
                // payment was successful: insert transaction data into the database
                $arr_payment_data = $response->getData();

                $isPaymentExist = Pago::where('payment_id', $arr_payment_data['id'])->first();

                if (!$isPaymentExist) {
                    $payment = new Pago;
                    $payment->payment_id = $arr_payment_data['id'];
                    $payment->payer_email = $request->email;
                    $payment->amount = $arr_payment_data['amount'] / 100;
                    $payment->currency = self::$STRIPE_CURRENCY;
                    $payment->payment_status = $arr_payment_data['status'];
                    $payment->save();
                }

                //ID PAGO: $arr_payment_data['id']

                //CREAR PEDIDO
                $order = new Compra();
                $order->payment_id = $arr_payment_data['id'];
                $order->nombre = $request->name . ' ' . $request->surname;
                $order->direccion = $request->address;
                $order->provincia = $request->province;
                $order->ciudad = $request->city;
                $order->telefono = $request->phone;
                $order->email = $request->email;
                $order->codPostal = $request->postalCode;
                $order->estado = 'realizada';
                $order->fecha = now();
                $order->importe = $total['precioTotal'];
                $order->id_user = 1; // Asume que el usuario está autenticado y quieres guardar su id
                $order->save();

                //CREAR LINEAS DEL PEDIDO
                $orders_lines = [];
                foreach ($productos as $pr){

                    $order_line = new ProductoCompra();
                    $order_line->cantidad = $pr->cantidad;
                    $order_line->precio_ud = $this->precioProducto($pr);
                    $order_line->id_producto = $pr->id;
                    $order_line->id_cliente = 1;
                    $order_line->id_compra = $order->id;
                    $order_line->save();

                    if ($pr->tipo === 'Selected'){
                        $product = Producto::find($pr->id);
                        $product->vendido = true;
                        $product->save();
                    }
                    $order_line->nombre = $pr->nombre;
                    $orders_lines[] = $order_line;
                }

                Mail::to($order->email)->send(new NewOrder($order,$orders_lines));
/*
                if ($_SERVER['HTTP_HOST'] != 'repuntet.localhost') {
                    Mail::to('info@3etern.es')->send(new NewOrderAdmin($order, $orders_lines));
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
                ]); */
            }
        }
        return redirect('/404');
    }
}
