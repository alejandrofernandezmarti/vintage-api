<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Marca::create([
            'nombre' => 'Nike',
        ]);
        Marca::create([
            'nombre' => 'Adidas',
        ]);
        Marca::create([
            'nombre' => 'Reebok',
        ]);
        Marca::create([
            'nombre' => 'Puma',
        ]);
        Marca::create([
            'nombre' => 'Champion',
        ]);
        Marca::create([
            'nombre' => 'Tommy Hilfiguer',
        ]);
        Marca::create([
            'nombre' => 'Lacoste',
        ]);
        Marca::create([
            'nombre' => 'Ralph Lauren',
        ]);
        Marca::create([
            'nombre' => 'Burberry',
        ]);
        Marca::create([
            'nombre' => 'Nautica',
        ]);
        Marca::create([
            'nombre' => 'Levis',
        ]);
        Marca::create([
            'nombre' => 'Wrangler',
        ]);
        Marca::create([
            'nombre' => 'Lee',
        ]);
        Marca::create([
            'nombre' => 'Gant',
        ]);
    }
}
