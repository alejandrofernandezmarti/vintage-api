<?php

namespace Database\Seeders;

use App\Models\ImagenCategoria;
use Illuminate\Database\Seeder;

class ImagenCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImagenCategoria::factory()->count(10)->create();
    }
}
