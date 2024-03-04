<?php

namespace Database\Factories;

use App\Models\ImagenCategoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImagenCategoriaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ImagenCategoria::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'url' => $this->faker->imageUrl(),
        ];
    }
}
