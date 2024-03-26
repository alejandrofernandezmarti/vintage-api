<?php

namespace Database\Seeders;

use App\Models\Compra;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComprasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = \App\Models\User::all();

        foreach ($users as $user) {
            $numOrders = rand(1, 6);
            for ($i = 0; $i < $numOrders; $i++) {
                \App\Models\Compra::factory()->create(['id_user' => $user->id]);
            }
        }
    }
}
