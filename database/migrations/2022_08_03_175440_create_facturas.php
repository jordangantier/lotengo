<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_comercio')
                ->nullable()
                ->cascadeOnUpdate()
                ->nullOnDelete()
                ->constrained('comercios');
            $table->foreignId('id_transaccion')
                ->nullable()
                ->cascadeOnUpdate()
                ->nullOnDelete()
                ->constrained('transacciones');
            $table->integer('num_factura')
                ->nullable();
            $table->integer('monto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}
