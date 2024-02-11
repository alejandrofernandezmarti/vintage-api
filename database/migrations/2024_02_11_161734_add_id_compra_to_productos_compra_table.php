<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('productos_compra', function (Blueprint $table) {
            $table->bigInteger('id_compra')->unsigned()->after('id_cliente');
            $table->foreign('id_compra')->references('id')->on('compras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productos_compra', function (Blueprint $table) {
            $table->dropForeign(['id_compra']);
            $table->dropColumn('id_compra');
        });
    }
};
