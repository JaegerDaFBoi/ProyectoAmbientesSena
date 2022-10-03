<?php

namespace Database\Seeders;

use App\Models\LearningOutcome;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LearningOutcomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resultados = [
            [
                "descripcion" => "Resultado Numero 1 Competencia 1",
                "trimestreasignacion" => 1,
                "trimestreevaluacion" => 2,
                "horassemana" => 4,
                "fk_competencia" => 1,
            ],
            [
                "descripcion" => "Resultado Numero 2 Competencia 1",
                "trimestreasignacion" => 2,
                "trimestreevaluacion" => 3,
                "horassemana" => 6,
                "fk_competencia" => 1,
            ],
            [
                "descripcion" => "Resultado Numero 1 Competencia 2",
                "trimestreasignacion" => 1,
                "trimestreevaluacion" => 2,
                "horassemana" => 4,
                "fk_competencia" => 2,
            ],
            [
                "descripcion" => "Resultado Numero 2 Competencia 2",
                "trimestreasignacion" => 2,
                "trimestreevaluacion" => 3,
                "horassemana" => 6,
                "fk_competencia" => 2,
            ],
        ];

        foreach ($resultados as $resultado) {
            LearningOutcome::create([
                'descripcion' => $resultado['descripcion'],
                'trimestreasignacion' => $resultado['trimestreasignacion'],
                'trimestreevaluacion' => $resultado['trimestreevaluacion'],
                'horassemana' => $resultado['horassemana'],
                'fk_competencia' => $resultado['fk_competencia']
            ]);
        }
    }
}
