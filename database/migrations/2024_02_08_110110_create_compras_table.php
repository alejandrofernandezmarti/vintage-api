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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->enum('estado',['pagado','enviado','cancelado','entregado']);
            $table->string('email');
            $table->float('importe');
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('provincia');
            $table->bigInteger('codPostal');
            $table->bigInteger('telefono');
            $table->string('nombre');
            $table->string("payment_id")->default('0');
            $table->foreignId('id_user')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
