<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Categoria;
use App\Models\Compra;
use App\Models\Imagen;
use App\Models\ImagenCategoria;
use App\Models\Marca;
use App\Models\Medida;
use App\Models\Producto;
use App\Models\ProductoCompra;
use App\Models\Talla;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::factory()->count(10)->create();
        Marca::factory()->count(15)->create();
        Talla::factory()->count(30)->create();
        Medida::factory()->count(40)->create();
        Categoria::factory()->count(10)->create();
        Compra::factory()->count(100)->create();
        Producto::factory()->count(100)->create();
        Imagen::factory()->count(50)->create();
        ProductoCompra::factory()->count(100)->create();
        ImagenCategoria::factory()->count(10)->create();

    }
}
