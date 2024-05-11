<?php

namespace Database\Seeders;

use App\Models\ImagenBox;
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
        ImagenBox::factory()->count(10)->create();
    }
}
