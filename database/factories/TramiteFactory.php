<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TramiteFactory extends Factory
{
    public function definition()
    {
        return [
            'documento' => $this->faker->sentence(3),
            'codigo' => 'TR-' . $this->faker->unique()->numerify('#######'),
            'solicitante' => $this->faker->name,
            'fecha_inicio' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'estado' => $this->faker->randomElement(['Pendiente', 'En revisión', 'Atendido']),
            'descripcion' => $this->faker->paragraph,
            'observaciones' => $this->faker->optional()->sentence,
            'resultado' => $this->faker->optional()->word,
            'archivo_adjunto' => $this->faker->optional()->word . '.pdf',
            'user_id' => User::factory(),
            'funcionario_destinatario' => $this->faker->email
        ];
    }
}