<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class TramiteExpedienteStructureTest extends TestCase
{
    use RefreshDatabase;

    public function test_tramite_expedientes_table_has_expected_columns(): void
    {
        $this->assertTrue(Schema::hasColumns('tramite_expedientes', [
            'codigo',
            'tramite_type_id',
            'sustento',
            'archivos',
        ]));
    }
}
