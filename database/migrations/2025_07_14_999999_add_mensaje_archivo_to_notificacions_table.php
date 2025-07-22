<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('notificacions', function (Blueprint $table) {
            $table->text('mensaje')->nullable()->after('estado');
            $table->string('archivo')->nullable()->after('mensaje');
        });
    }

    public function down(): void
    {
        Schema::table('notificacions', function (Blueprint $table) {
            $table->dropColumn(['mensaje', 'archivo']);
        });
    }
};
