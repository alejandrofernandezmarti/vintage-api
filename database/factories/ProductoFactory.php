<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Producto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->sentence(),
            'precio' => $this->faker->randomFloat(2, 10, 70),
            'descuento' => $this->faker->optional()->randomFloat(2, 70, 100),
            'id_marca' => \App\Models\Marca::all()->random()->id,
            'id_categoria' => \App\Models\Categoria::all()->random()->id,
            'id_talla' => \App\Models\Talla::all()->random()->id,
            'id_medidas' => \App\Models\Medida::all()->random()->id,
            'estado' => $this->faker->randomElement(['nuevo', 'muy bien', 'bien', 'algun defecto', 'malo']),
            'activo' => $this->faker->boolean(10),
            'vendido' => $this->faker->boolean(0.1),
        ];
    }
}
