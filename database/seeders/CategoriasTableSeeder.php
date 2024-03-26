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
        ]);
        Categoria::create([
            'nombre' => 'Jerseis',
            'tipo' => 'Tops',
            'imagen' => 'Jerseis.png',
        ]);

        Categoria::create([
            'nombre' => 'Camisetas',
            'tipo' => 'Tops',
            'imagen' => 'Camisetas.png',
        ]);

        Categoria::create([
            'nombre' => 'Camisas',
            'tipo' => 'Tops',
            'imagen' => 'Camisas.png',
        ]);
        Categoria::create([
            'nombre' => 'Chaquetas',
            'tipo' => 'Tops',
            'imagen' => 'Chaquetas.png',
        ]);
        Categoria::create([
            'nombre' => 'Cazadoras',
            'tipo' => 'Tops',
            'imagen' => 'Cazadoras.png',
        ]);
        Categoria::create([
            'nombre' => 'Pantalones',
            'tipo' => 'Bottoms',
            'imagen' => 'Pantalones.png',
        ]);
        Categoria::create([
            'nombre' => 'Shorts',
            'tipo' => 'Bottoms',
            'imagen' => 'Shorts.png',
        ]);

    }
}
