<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('notificacions', function (Blueprint $table) {
        $table->dateTime('fecha_archivo')->nullable();
        $table->string('archivado_por')->nullable();
    });
}

public function down(): void
{
    Schema::table('notificacions', function (Blueprint $table) {
        $table->dropColumn([
            'tipo',
            'estado',
            'fecha_archivo',
            'archivado_por',
        ]);
    });
    }   
};