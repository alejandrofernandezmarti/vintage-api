<?php

namespace Database\Seeders;

use App\Models\ImagenProducto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImagenesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ImagenProducto::factory()->count(10)->create();
    }
}
