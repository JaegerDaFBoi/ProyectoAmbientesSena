<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Area;
use App\Models\Instructor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class TablaInstructores extends Component
{

    public $infoInstructor = false;
    public $idInstructor;
    public $nombre;
    public $apellidos;
    public $cedula;
    public $area;
    public $tipo;
    public $vinculacion;
    public $horassemana;
    public $email;

   
    // Metodo para asignar datos del instructor a propiedades para mostrar informacion en la vista
    public function setInstructor($id)
    {
        $this->infoInstructor = true;
        $this->idInstructor = $id;
        $instructor = Instructor::find($id);
        $this->nombre = $instructor->nombre;
        $this->apellidos = $instructor->apellidos;
        $this->cedula = $instructor->cedula;
        $this->area = $instructor->area->nombre;
        $this->tipo = $instructor->tipo;
        $this->vinculacion = $instructor->vinculacion;
        $this->horassemana = $instructor->horassemana;
        $this->email = $instructor->email;
    }

    public function cerrar()
    {
        $this->infoInstructor = false;
    }

    public function borrarInstructor($id)
    {
        $instructor = Instructor::where('isEliminated', false)->where('id', $id)->first();
        $instructor->isEliminated = true;
        $instructor->save();
        return Redirect::route('instructores.index')->with("message", "Instructor Eliminado Correctmente");
    }

    public function render()
    {
        return view('livewire.instructor.tabla-instructores', [
            'instructores' => Instructor::where('isEliminated', false)->get()
        ]);
    }
}
