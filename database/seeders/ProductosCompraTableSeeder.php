<?php

namespace Database\Seeders;

use App\Models\ProductoCompra;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductosCompraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        ProductoCompra::factory()->count(100)->create(); // Creates 10 productos-compra using the ProductosCompraFactory
    }
}
