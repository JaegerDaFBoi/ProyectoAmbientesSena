<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eventos = [
            [
                "title" => "2207208 - MAURICIO VALENCIA ZULUAGA",
                "description" => "Descripcion del evento",
                "start" => "2022-10-05 18:00:00",
                "end" => "2022-10-05 22:00:00",
                "fk_assignment" => 1,
            ],
            [
                "title" => "2207208 - GERMAN ANDRES AGUIRRE VALENCIA",
                "description" => "Descripcion del evento",
                "start" => "2022-10-06 18:00:00",
                "end" => "2022-10-06 22:00:00",
                "fk_assignment" => 2,
            ]
        ];

        foreach ($eventos as $evento) {
            Event::create([
                'title' => $evento['title'],
                'description' => $evento['description'],
                'start' => $evento['start'],
                'end' => $evento['end'],
                'fk_assignment' => $evento['fk_assignment']
            ]);
        }
    }
}
