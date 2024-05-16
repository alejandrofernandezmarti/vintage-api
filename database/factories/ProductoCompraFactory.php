<?php

namespace Database\Factories;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\ProductoCompra;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductoCompra>
 */
class ProductoCompraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ProductoCompra::class;



    /**
     * Define the model's default state.
     *
     * @return array
     */
    /*public function definition()
    {
        // Generar una nueva compra
        $compra = Compra::factory()->create();

        // Generar un número aleatorio de productos entre 2 y 6
        $numProductos = $this->faker->numberBetween(2, 6);

        $productos = [];
        for ($i = 0; $i < $numProductos; $i++) {
            // Obtener un producto aleatorio
            $producto = Producto::all()->random();

            // Calcular el precio final dependiendo del tipo de producto
            if ($producto->tipo === 'Box') {
                $cantidad = $this->faker->randomElement([10, 20, 30, 50, 70, 100]);
                switch ($cantidad) {
                    case 20:
                        $descuento = 4;
                        break;
                    case 30:
                        $descuento = 8;
                        break;
                    case 50:
                        $descuento = 12;
                        break;
                    case 70:
                        $descuento = 16;
                        break;
                    case 100:
                        $descuento = 20;
                        break;
                    default:
                        $descuento = 0;
                }
                $precio_final = $producto->precio_ud - ($producto->precio_ud * $descuento / 100);
            } else {
                $cantidad = $producto->cantidad;
            }

            // Agregar el producto a la lista de productos de la compra
            $productos[] = [
                'id_producto' => $producto->id,
                'cantidad' => $cantidad,
                'precio_ud' => $producto->tipo === 'Selected' ? $producto->precio_ud : $precio_final,
                'id_compra' => $compra->id,
                'id_cliente' => $compra->id_user,
            ];
        }

        // Asociar los productos a la compra
        $compra->productos()->createMany($productos);

        return [];
    } */
    public function definition()
    {
        $producto = Producto::all()->random();
        $precio_ud = $producto->precio_ud;
        $tipo = $producto->tipo;

        if ($tipo === 'Box') {
            $cantidad = $this->faker->randomElement([10, 20, 30, 50, 70, 100]);

            switch ($cantidad) {
                case 20:
                    $descuento = 4;
                    break;
                case 30:
                    $descuento = 8;
                    break;
                case 50:
                    $descuento = 12;
                    break;
                case 70:
                    $descuento = 16;
                    break;
                case 100:
                    $descuento = 20;
                    break;
                default:
                    $descuento = 0;
            }

            $precio_final = $precio_ud - ($precio_ud * $descuento / 100);

        } else {
            $cantidad = $producto->cantidad;
        }

        return [
            'id_producto' => $producto->id,
            'cantidad' => $cantidad,
            'precio_ud' => $tipo === 'Selected' ? $precio_ud : $precio_final,
            'id_compra' => \App\Models\Compra::all()->random()->id,
            'id_cliente' => \App\Models\User::all()->random()->id,
        ];
    }
}
