<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransacciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')
                ->nullable()
                ->cascadeOnUpdate()
                ->nullOnDelete()
                ->constrained('users');
            $table->foreignId('id_participante')
                ->nullable()
                ->cascadeOnUpdate()
                ->nullOnDelete()
                ->constrained('participantes');
            $table->Integer('monto_acumulado');
            $table->smallInteger('qty_boletos');
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
        Schema::dropIfExists('transacciones');
    }
}
