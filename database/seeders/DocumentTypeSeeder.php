<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Solicitud', 'Constancia', 'Certificado', 'Resolución',
            'Informe', 'Memorando', 'Oficio',
        ];

        foreach ($types as $name) {
            \App\Models\DocumentType::create(['name' => $name]);
        }
    }
}
