<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductoResource;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\ProductoCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            if ($user->isAdmin()) {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'You are not authorized to access this area.',
                ])->withInput();
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function dashboard() {
        return view('admin.dashboard');
    }
    public function adminCompras(){
        return view('admin.ordersDashboard');
    }

    public function orderHistory(Request $request)
    {
        $query = Compra::query();

        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('email', 'like', "%{$search}%")
                    ->orWhere('ciudad', 'like', "%{$search}%")
                    ->orWhere('telefono', 'like', "%{$search}%")
                    ->orWhere('nombre', 'like', "%{$search}%");
            });
        }

        $orders = $query->get();
        return view('admin.ordersHistory', compact('orders'));
    }
    public function newOrders()
    {
        $orders = Compra::where('estado', 'pagado')->get();
        return view('admin.newOrders', compact('orders'));
    }
    public function orderDetail($id)
    {
        $order = Compra::with('productos')->findOrFail($id);
        $productosInfo = ProductoCompra::where('id_compra', $id)->get();

        $productos = collect();

        foreach ($productosInfo as $productoInfo) {
            $producto = Producto::find($productoInfo->id_producto);
            if ($producto) {
                $productoClone = clone $producto;
                $productoClone->cantidad = $productoInfo->cantidad;
                $productoClone->precio_ud = $productoInfo->precio_ud;
                $productos->push($productoClone);
            }
        }

        return view('admin.orderDetail', compact('order', 'productos'));
    }
    public function productos(Request $request)
    {
        $query = Producto::query();

        // Aplicar filtro de búsqueda por nombre
        if ($request->has('search') && $request->input('search') != '') {
            $query->where('nombre', 'like', '%' . $request->input('search') . '%');
        }

        // Aplicar filtro por tipo
        if ($request->has('type') && $request->input('type') != '') {
            $query->where('tipo', $request->input('type'));
        }

        $productos = $query->get();
        $productos = ProductoResource::collection($productos);

        return view('admin.productos', compact('productos'));
    }

}
