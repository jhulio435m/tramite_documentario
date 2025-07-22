<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('notificacions', function (Blueprint $table) {
            $table->dateTime('fecha_entrega')->nullable()->after('archivo');
            $table->string('estado_entrega')->nullable()->after('fecha_entrega');
            $table->string('receptor')->nullable()->after('estado_entrega');
            $table->text('observaciones')->nullable()->after('receptor');
        });
    }

    public function down(): void
    {
        Schema::table('notificacions', function (Blueprint $table) {
            $table->dropColumn([
                'fecha_entrega',
                'estado_entrega',
                'receptor',
                'observaciones',
            ]);
        });
    }
};
