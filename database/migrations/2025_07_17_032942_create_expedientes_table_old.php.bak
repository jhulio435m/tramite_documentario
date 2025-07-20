<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(){
        Schema::create('expedientes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo'); // Ej: EXP-0001
            $table->string('solicitante');
            $table->date('fecha_ingreso');
            $table->string('estado');
            $table->string('sumilla');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expedientes');
    }
};
