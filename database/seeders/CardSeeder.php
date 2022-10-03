<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fichas = [
            [
                "numero" => 2207208,
                "fk_programa" => 1,
                "jornada" => "Nocturna",
                "modalidad" => "Presencial",
                "fechainicio" => "2022-06-10",
                "fechafin" => "2024-06-10",
                "fk_instructor" => 2,
                "cantidad" => 20
            ],
        ];

        foreach ($fichas as $ficha) {
            Card::create([
                'numero' => $ficha['numero'],
                'fk_programa' => $ficha['fk_programa'],
                'jornada' => $ficha['jornada'],
                'modalidad' => $ficha['modalidad'],
                'fechainicio' => $ficha['fechainicio'],
                'fechafin' => $ficha['fechafin'],
                'fk_instructor' => $ficha['fk_instructor'],
                'cantidad' => $ficha['cantidad'] 
            ]);
        }
    }
}
