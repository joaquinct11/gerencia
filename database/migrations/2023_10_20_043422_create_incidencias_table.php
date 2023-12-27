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
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('codigoUsu');
            $table->foreign('codigoUsu')->references('id')->on('users');
            $table->string('tipoInci', 50);
            $table->string('descInci', 50);
            $table->date('fechRegiInci');
            $table->string('soluInci', 50);
            $table->date('fechSoluInci');
            $table->string('estaInci', 20);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidencias');
    }
};
