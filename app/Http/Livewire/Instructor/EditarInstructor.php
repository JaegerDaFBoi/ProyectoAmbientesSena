<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Area;
use App\Models\Instructor;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class EditarInstructor extends Component
{

    public $idinstructor;
    public $nombre;
    public $apellidos;
    public $cedula;
    public $area;
    public $tipo;
    public $vinculacion;
    public $email;
    public $horas;

    protected $rules = [
        'nombre' => 'required|alpha',
        'apellidos' => 'required|alpha',
        'cedula' => 'required|numeric',
        'area' => 'required',
        'tipo' => 'required|alpha',
        'vinculacion' => 'required|alpha',
        'horas' => 'required|numeric|max:200',
        'email' => 'required|email'
      ];

    public function mount(Instructor $instructor)
    {
        $this->idinstructor = $instructor->id;
        $this->nombre = $instructor->nombre;
        $this->apellidos = $instructor->apellidos;
        $this->cedula = $instructor->cedula;
        $this->area = $instructor->fk_area;
        $this->tipo = $instructor->tipo;
        $this->vinculacion = $instructor->vinculacion;
        $this->email = $instructor->email;
        $this->horas = $instructor->horassemana;
    }

    public function editInstructor($id)
    {
        $this->validate();
        $instructor = Instructor::where('isEliminated', false)->where('id', $id)->first();
        $instructor->nombre = $this->nombre;
        $instructor->apellidos = $this->apellidos;
        $instructor->cedula = $this->cedula;
        $instructor->fk_area = $this->area;
        $instructor->tipo = $this->tipo;
        $instructor->vinculacion = $this->vinculacion;
        $instructor->email = $this->email;
        $instructor->horassemana = $this->horas;
        $instructor->save();
        return Redirect::route('instructores.index');
    }

    public function render()
    {
        return view('livewire.instructor.editar-instructor', [
            'areas' => Area::all()
        ]);
    }
}
