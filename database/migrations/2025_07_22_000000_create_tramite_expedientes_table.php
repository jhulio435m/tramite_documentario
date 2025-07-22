<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tramite_expedientes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->foreignId('tramite_type_id')->constrained('tramite_types');
            $table->text('sustento')->nullable();
            $table->json('archivos')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tramite_expedientes');
    }
};
