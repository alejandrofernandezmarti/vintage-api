<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos_compra', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->float('precio_ud');
            $table->foreignId('id_producto')->constrained('productos');
            $table->foreignId('id_cliente')->constrained('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos_compra');
    }
};
