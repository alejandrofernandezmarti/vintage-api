<?php

namespace Database\Factories;

use App\Models\ProductosCompra;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductosCompra>
 */
class ProductosCompraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ProductosCompra::class;



    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_producto' => \App\Models\Producto::all()->random()->id,
            'id_compra' => \App\Models\Compra::all()->random()->id,
            'id_cliente' => \App\Models\User::all()->random()->id,
        ];
    }
}
