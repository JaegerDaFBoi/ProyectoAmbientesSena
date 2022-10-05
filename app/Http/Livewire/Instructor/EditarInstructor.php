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
        'nombre' => 'required',
        'apellidos' => 'required',
        'cedula' => 'required|numeric',
        'area' => 'required',
        'tipo' => 'required|alpha',
        'vinculacion' => 'required|alpha',
        'horas' => 'required|numeric|max:200',
        'email' => 'required|email'
    ];

    protected $messages = [
        'nombre.required' => 'El campo Nombre es obligatorio',
        'apellidos.required' => 'El campo Apellidos es obligatorio',
        'cedula.required' => 'El campo Cédula es obligatorio',
        'cedula.numeric' => 'El campo Cédula solo puede contener números',
        'area.required' => 'El campo Area es obligatorio',
        'tipo.required' => 'Debe seleccionar un tipo de instructor',
        'vinculacion.required' => 'Debe seleccionar un tipo de vinculación',
        'horas.required' => 'El campo Horas Semanales es obligatorio',
        'horas.numeric' => 'El campo Horas Semanales solo puede contener números',
        'email.required' => 'El campo Correo Electronico es obligatorio',
        'email.email' => 'El campo Correo Electronico debe ser un correo válido'
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
        return Redirect::route('instructores.index')->with("message", "Instructor Actualizado Correctamente");
    }

    public function render()
    {
        return view('livewire.instructor.editar-instructor', [
            'areas' => Area::all()
        ]);
    }
}
