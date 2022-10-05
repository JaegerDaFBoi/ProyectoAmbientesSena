<div>
    <div class="card">
        <div class="card-header text-center" style="background-color: #F05C12">
            <h4>Formulario para editar instructor</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <x-adminlte-alert theme="warning" title="Atención" dismissable>
                <p class="text-dark">Oops! Hay errores en el registro.</p>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-adminlte-alert>
            @endif
            <form wire:submit.prevent='editInstructor({{ $idinstructor }})' method="post">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="nombreInstructor" class="text-dark">Nombre</label>
                        <input type="text" id="nombreInstructor" name="nombreInstructor" class="form-control" wire:model='nombre'>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="apellidosInstructor" class="text-dark">Apellidos</label>
                        <input type="text" id="apellidosInstructor" name="apellidosInstructor" class="form-control" wire:model='apellidos'>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="cedulaInstructor" class="text-dark">Cédula</label>
                        <input type="text" id="cedulaInstructor" name="cedulaInstructor" class="form-control" wire:model="cedula">
                    </div>
                </div>
                <div class="row">
                    <div class=" form-group col-md-6">
                        <x-adminlte-select id="selectArea" name="selectArea" label="Área" label-class="text-dark" wire:model="area">
                            <x-slot name="prependSlot">
                                <div class="input-group-text bg-gradient-orange">
                                    <i class="far fa-clone"></i>
                                </div>
                            </x-slot>
                            <option>Seleccione un area</option>
                            @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                            @endforeach
                        </x-adminlte-select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="tipoInstructor">Tipo de Instructor</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipoInstructor" value="Virtual" wire:model="tipo">
                            <label class="form-check-label">Virtual</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipoInstructor" value="Presencial" wire:model="tipo">
                            <label class="form-check-label">Presencial</label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="vinculacionInstructor">Vinculación</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="vinculacionInstructor" value="Planta" wire:model="vinculacion">
                            <label class="form-check-label">Planta</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="vinculacionInstructor" value="Contratista" wire:model="vinculacion">
                            <label class="form-check-label">Contratista</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="emailInstructor" class="text-dark">Correo Electronico</label>
                        <input type="email" id="emailInstructor" name="emailInstructor" class="form-control" wire:model="email">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="horasInstructor" class="text-dark">Horas Semanales</label>
                        <input type="number" id="horasInstructor" name="horasInstructor" class="form-control" wire:model="horas">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-block" style="background-color: #F05C12">
                            <i class="fas fa-lg fa-save"></i>
                            Guardar Cambios
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>