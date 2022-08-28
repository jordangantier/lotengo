<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateBoletos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boletos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_transaccion')
                ->nullable()
                ->cascadeOnUpdate()
                ->nullOnDelete()
                ->constrained('transacciones');
            $table->boolean('habilitado')
                ->default(0);
            $table->tinyInteger('concurso');
            $table->integer('serie');
            $table->string('hasher', 32);
            $table->string('hash', 32);
            $table->json('numeros');
            $table->tinyInteger('contador1')
                ->default(15);
            $table->tinyInteger('contador2')
                ->default(15);
            $table->tinyInteger('contador3')
                ->default(15);
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
        Schema::dropIfExists('boletos');
    }
}
