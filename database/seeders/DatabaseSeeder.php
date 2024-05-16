<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Compra;
use App\Models\ImagenProducto;
use App\Models\ProductoCompra;
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
        $this->call(CategoriasTableSeeder::class);
        Compra::factory()->count(100)->create();
        ImagenProducto::factory()->count(20)->create();
        ProductoCompra::factory()->count(300)->create();

    }
}
