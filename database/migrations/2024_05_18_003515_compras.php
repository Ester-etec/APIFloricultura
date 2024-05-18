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
            $table->decimal('valortotal', 8, 2);
            $table->integer('quantidade');
            $table->unsignedBigInteger('id_planta');
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_funcinario');


            $table->foreign('id_planta')->references('id')->on('plantas');
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->foreign('id_funcinario')->references('id')->on('funcinarios');
            $table->timestamps();
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