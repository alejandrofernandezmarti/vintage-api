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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('precio');
            $table->string('nombre');
            $table->foreignId('id_marca')->constrained('marcas');
            $table->foreignId('id_categoria')->constrained('categorias');
            $table->foreignId('id_talla')->constrained('tallas');
            $table->foreignId('id_medidas')->constrained('medidas');
            $table->enum('estado',['nuevo','muy bien','bien','algun defecto','malo']);
            $table->boolean('activo');
            $table->boolean('vendido');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
