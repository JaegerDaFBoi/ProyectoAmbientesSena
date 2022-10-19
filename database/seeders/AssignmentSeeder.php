<?php

namespace Database\Seeders;

use App\Models\Assignment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $asignaciones = [
            [
                "fk_ficha" => 1,
                "fk_competencia" => 2,
                "fk_resultado" => 3,
                "fk_instructor" => 2,
                "fk_ambiente" => 2,
                "tipo" => "Titulada",
                "descripcion" => "La descripcion del evento es opcional"
            ],
            [
                "fk_ficha" => 1,
                "fk_competencia" => 1,
                "fk_resultado" => 2,
                "fk_instructor" => 1,
                "fk_ambiente" => 1,
                "tipo" => "Titulada",
                "descripcion" => "La descripcion del evento es opcional"
            ],
            [
                "fk_ficha" => 1,
                "fk_competencia" => 2,
                "fk_resultado" => 3,
                "fk_instructor" => 2,
                "fk_ambiente" => 2,
                "tipo" => "Titulada",
                "descripcion" => "La descripcion del evento es opcional"
            ]
        ];

        foreach ($asignaciones as $asignacion) {
            Assignment::Create([
                'fk_ficha' => $asignacion['fk_ficha'],
                'fk_competencia' => $asignacion['fk_competencia'],
                'fk_resultado' => $asignacion['fk_resultado'],
                'fk_instructor' => $asignacion['fk_instructor'],
                'fk_ambiente' => $asignacion['fk_ambiente'],
                'tipo' => $asignacion['tipo'],
                'descripcion' => $asignacion['descripcion']
            ]);
        }
    }
}
