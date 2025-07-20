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
        Schema::create('expedientes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('name');
            $table->string('dni', 8)->nullable();
            $table->year('year')->nullable()->index();
            $table->foreignId('month_id')->nullable()->constrained('months')->index();
            $table->foreignId('faculty_id')->nullable()->constrained('facultades')->index();
            $table->foreignId('document_type_id')->nullable()->constrained('document_types')->index();
            $table->foreignId('status_id')->nullable()->constrained('statuses')->index();
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
