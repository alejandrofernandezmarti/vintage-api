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
            $table->float('precio_ud');
            $table->integer('cantidad');
            $table->string('nombre');
            $table->longText('descripcion');
            $table->foreignId('id_categoria')->constrained('categorias');
            $table->enum('estado',['Grado A','Grado B','Calidad premium']);
            $table->enum('tipo',['Box','Selected']);
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
