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
        $tipo = $this->faker->randomElement(['Box', 'Selected']);
        $cantidad = $tipo === 'Box' ? 0 : $this->faker->randomElement([10, 20, 30, 50, 70, 100]);

        return [
            'nombre' => $this->faker->sentence(),
            'precio_ud' => $this->faker->randomFloat(2, 3, 18),
            'cantidad' => $cantidad,
            'descripcion' => $this->faker->paragraph(),
            'id_categoria' => \App\Models\Categoria::all()->random()->id,
            'estado' => $this->faker->randomElement(['Grado A', 'Grado B', 'Calidad premium']),
            'activo' => $this->faker->boolean(10),
            'vendido' => $this->faker->boolean(0.1),
            'tipo' => $tipo,
        ];
    }

}
