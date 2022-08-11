<?php

namespace Database\Seeders;

use App\Models\Environment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnvironmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ambientes = [
            [
                "nombre" => "Control Electrico",
                "tipo" => "Presencial",
                "aforo" => 20
            ],
            [
                "nombre" => "TIC",
                "tipo" => "Presencial",
                "aforo" => 20
            ]

        ];
        
        foreach ($ambientes as $ambiente) {
            Environment::create([
                'nombre' => $ambiente['nombre'],
                'tipo' => $ambiente['tipo'],
                'aforo' => $ambiente['aforo']
            ]);
        }
    }
}
