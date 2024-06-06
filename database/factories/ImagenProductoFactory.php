<?php

namespace Database\Factories;

use App\Models\ImagenProducto;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ImagenProducto>
 */
class ImagenProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ImagenProducto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'producto_id' => Producto::factory(),
            'url_1' => "https://source.unsplash.com/random/1000x1000",
            'url_2' => "https://source.unsplash.com/random/1000x999",
            'url_3' => "https://source.unsplash.com/random/999x1000",
            'url_4' => "https://source.unsplash.com/random/980x1000",
            'url_5' => "https://source.unsplash.com/random/1000x980",
            'url_6' => "https://source.unsplash.com/random/987x999",

        ];
    }
}
