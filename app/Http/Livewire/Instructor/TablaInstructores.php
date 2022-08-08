<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Area;
use App\Models\Instructor;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TablaInstructores extends Component
{

    public $idInstructor;
    public $nombre;
    public $apellidos;
    public $cedula;
    public $area;
    public $tipo;
    public $vinculacion;
    public $horassemana;
    public $email;

    public function setInstructor($id)
    {
        $this->idInstructor = $id;
        $instructor = DB::table('instructors')->where('id', $id)->first();
        $this->nombre = $instructor->nombre;
        $this->apellidos = $instructor->apellidos;
        $this->cedula = $instructor->cedula;
        $areainstructor = DB::table('areas')->where('id', $instructor->fk_area)->first();
        $this->area = $areainstructor->nombre;
        $this->tipo = $instructor->tipo;
        $this->vinculacion = $instructor->vinculacion;
        $this->horassemana = $instructor->horassemana;
        $this->email = $instructor->email;
    }

    public function render()
    {
        return view('livewire.instructor.tabla-instructores', [
            'instructores' => Instructor::where('isEliminated', false)->get()
        ]);
    }
}
