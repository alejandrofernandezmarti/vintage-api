<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Categoria::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->randomElement(['sudadera', 'camiseta', 'camisa', 'chaleco', 'chaqueta', 'cazadora', 'pantalones', 'shorts', 'tops']),
            'tipo' => $this->faker->randomElement(['accesorios', 'tops', 'bottoms']),
        ];
    }
}
