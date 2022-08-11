<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programas = [
            [
                "codigo" => "228106",
                "nombre" => "ANALISIS Y DESARROLLO DE SISTEMAS DE INFORMACION",
                "duracionlectiva" => 18,
                "duracionpractica" => 6,
                "nivelformacion" => "Tecnologo",
                "perfilinstructor" => "El programa requiere de un equipo de instructores con Título de Tecnólogo o Cuatro (4) años de
                Estudios Universitarios, relacionados con la especialidad objeto de formación, preferiblemente con
                Certificación Internacional en Desarrollo de Soluciones de Software ya sea en Tecnologías Sun
                Microsystems (Java o MySQL), Microsoft (Visual Studio o SQL Server) u Oracle (Administración o
                Desarrollo sobre PL/SQL)",
                "totaltrimestres" => 8,
                "descripcion" => "Ejecuta el proceso integral (análisis, diseño, implementación, pruebas y ajustes) de generación de
                sistemas de información, para la sitematización o automatización de procesos."
            ]
        ];

        foreach ($programas as $programa) {
            Program::create([
                'codigo' => $programa['codigo'],
                'nombre' => $programa['nombre'],
                'duracionlectiva' => $programa['duracionlectiva'],
                'duracionpractica' => $programa['duracionpractica'],
                'nivelformacion' => $programa['nivelformacion'],
                'perfilinstructor' => $programa['perfilinstructor'],
                'totaltrimestres' => $programa['totaltrimestres'],
                'descripcion' => $programa['descripcion']
            ]);
        }
    }
}
