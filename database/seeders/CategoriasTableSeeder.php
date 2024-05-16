<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Categoria::create([
            'nombre' => 'Sudaderas',
            'tipo' => 'Tops',
            'imagen' => 'Sudaderas.png',
            'precio_env' => 8,
        ]);
        Categoria::create([
            'nombre' => 'Jerseis',
            'tipo' => 'Tops',
            'imagen' => 'Jerseis.png',
            'precio_env' => 9,
        ]);

        Categoria::create([
            'nombre' => 'Camisetas',
            'tipo' => 'Tops',
            'imagen' => 'Camisetas.png',
            'precio_env' => 4,
        ]);

        Categoria::create([
            'nombre' => 'Camisas',
            'tipo' => 'Tops',
            'imagen' => 'Camisas.png',
            'precio_env' => 4,
        ]);
        Categoria::create([
            'nombre' => 'Chaquetas',
            'tipo' => 'Tops',
            'imagen' => 'Chaquetas.png',
            'precio_env' => 6,
        ]);
        Categoria::create([
            'nombre' => 'Cazadoras',
            'tipo' => 'Tops',
            'imagen' => 'Cazadoras.png',
            'precio_env' => 8,
        ]);
        Categoria::create([
            'nombre' => 'Pantalones',
            'tipo' => 'Bottoms',
            'imagen' => 'Pantalones.png',
            'precio_env' => 4.5,
        ]);
        Categoria::create([
            'nombre' => 'Shorts',
            'tipo' => 'Bottoms',
            'imagen' => 'Shorts.png',
            'precio_env' => 3.5,
        ]);

    }
}
