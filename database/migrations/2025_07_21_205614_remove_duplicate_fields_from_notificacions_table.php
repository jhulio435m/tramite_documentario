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
    Schema::table('notificacions', function (Blueprint $table) {
        if (Schema::hasColumn('notificacions', 'tipo_tramite')) {
            $table->dropColumn('tipo_tramite');
        }

        if (Schema::hasColumn('notificacions', 'estado_tramite')) {
            $table->dropColumn('estado_tramite');
        }
    });
}


public function down(): void
{
    Schema::table('notificacions', function (Blueprint $table) {
        $table->string('tipo_tramite')->nullable();
        $table->string('estado_tramite')->nullable();
    });
}
};
