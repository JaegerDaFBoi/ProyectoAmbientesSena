<?php

namespace Database\Seeders;

use App\Models\Competence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $competencias = [
            [
                "codigo" => "2512",
                "descripcion" => "Competencia Numero 1",
                "fk_programa" => 1
            ],
            [
                "codigo" => "2513",
                "descripcion" => "Competencia Numero 2",
                "fk_programa" => 1
            ]
        ];

        foreach ($competencias as $competencia) {
            Competence::create([
                'codigo' => $competencia['codigo'],
                'descripcion' => $competencia['descripcion'],
                'fk_programa' => $competencia['fk_programa'],
            ]);
        }
    }
}
