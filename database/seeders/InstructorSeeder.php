<?php

namespace Database\Seeders;

use App\Models\Instructor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $instructores = [
            [
                "nombre" => "GERMAN ANDRES",
                "apellidos" => "AGUIRRE VALENCIA",
                "cedula" => "75099753",
                "fk_area" => 1,
                "tipo" => "Presencial",
                "vinculacion" => "Planta",
                "horassemana" => 120,
                "email" => "german353@misena.edu.co"
            ],
            [
                "nombre" => "MAURICIO",
                "apellidos" => "VALENCIA ZULUAGA",
                "cedula" => "1056984712",
                "fk_area" => 2,
                "tipo" => "Virtual",
                "vinculacion" => "Contratista",
                "horassemana" => 160,
                "email" => "kat10@misena.edu.co"
            ]
        ];

        foreach ($instructores as $instructor)
        {
            Instructor::create([
                'nombre' => $instructor['nombre'],
                'apellidos' => $instructor['apellidos'],
                'cedula' => $instructor['cedula'],
                'fk_area' => $instructor['fk_area'],
                'tipo' => $instructor['tipo'],
                'vinculacion' => $instructor['vinculacion'],
                'horassemana' => $instructor['horassemana'],
                'email' => $instructor['email']
            ]);
        }
    }
}
