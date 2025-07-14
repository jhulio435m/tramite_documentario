<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up()
{
    Schema::create('notificacions', function (Blueprint $table) {
        $table->id();
        $table->string('tramite_id');
        $table->dateTime('fecha_solicitud');
        $table->string('documento');
        $table->string('tipo');
        $table->string('destinatario_nombre');
        $table->string('destinatario_direccion');
        $table->string('destinatario_contacto');
        $table->string('funcionario');
        $table->string('estado')->default('Pendiente');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('notificacions');
    }
};
