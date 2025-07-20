<?php

namespace Database\Factories;

use App\Models\Expedientes;
use App\Models\Facultad;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Expedientes>
 */
class ExpedientesFactory extends Factory
{
    protected $model = Expedientes::class;

    public function definition(): array
    {
        $months = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre',
        ];

        $types = ['Solicitud', 'Constancia', 'Certificado', 'Resolución', 'Informe', 'Memorando', 'Oficio'];
        $statuses = ['Pendiente', 'En Proceso', 'Finalizado'];

        return [
            'codigo' => strtoupper(Str::random(8)),
            'name' => $this->faker->name(),
            'year' => $this->faker->numberBetween(2021, 2025),
            'month' => $this->faker->randomElement($months),
            'faculty_id' => Facultad::inRandomOrder()->value('id'),
            'document_type' => $this->faker->randomElement($types),
            'status' => $this->faker->randomElement($statuses),
            'sumilla' => $this->faker->sentence(),
            'observaciones' => $this->faker->optional()->sentence(),
        ];
    }
}
