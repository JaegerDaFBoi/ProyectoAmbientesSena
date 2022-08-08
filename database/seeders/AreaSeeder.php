<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = [
            [
                "nombre" => "AREA DE SISTEMAS, MANTENIMIENTO DE EQUIPOS DE COMPUTO Y DISEÑO GRAFICO Y MULTIMEDIAL"
            ],
            [
                "nombre" => "AREA DE ELECTRONICA Y MANTENIMIENTO ELECTRONICO"
            ],
            [
                "nombre" => "AREA DE DISEÑO, IMPLEMENTACION Y MANTENIMIENTO DE SISTEMAS DE TELECOMUNICACIONES"
            ],
            [
                "nombre" => "AREA DE TELEINFORMATICA Y ADSI"
            ],
            [
                "nombre" => "AREA DE CNC"
            ],
            [
                "nombre" => "GESTION DE LA PRODUCCION INDUSTRIAL"
            ],
            [
                "nombre" => "AREA DE AUTOMATIZACION INDUSTRIAL Y DISEÑO E INTEGRACION DE AUTOMATISMOS MECATRONICOS"
            ],
            [
                "nombre" => "INTERACCION IDONEA COMUNICACION"
            ],
            [
                "nombre" => "INGLES"
            ],
            [
                "nombre" => "MANTENIMIENTO BIOMEDICO"
            ],
            [
                "nombre" => "CULTURA FISICA"
            ],
            [
                "nombre" => "EMPRENDIMIENTO"
            ],
        ];

        foreach ($areas as $area) {
            Area::create([
                'nombre' => $area['nombre']
            ]);
        }
    }
}
