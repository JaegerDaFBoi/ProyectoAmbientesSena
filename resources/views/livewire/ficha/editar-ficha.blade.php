<div>
    <div class="card">
        <div class="card-header text-center bg-gradient-orange">
            <h4 class="text-navy">Formulario para edición de ficha de formación</h4>
        </div>
        <div class="card-body bg-gradient-gray">
            @if ($errors->any())
            <div class="alert alert-warning" role="alert">
                <div class="row">
                    <div class="col-lg-6">
                        <p class="text-dark">Oops! Hay errores en el registro.</p>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            <form wire:submit.prevent='editarFicha' method="post">
                <div class="row">
                    <x-adminlte-input name="numeroFicha" label="Número de ficha" label-class="text-navy" fgroup-class="col-md-6" wire:model='numero'  />
                    <x-adminlte-select name="programaFicha" label="Programa de formación" label-class="text-navy" fgroup-class="col-md-6" wire:model='programa'>
                        @foreach ($programas as $programa)
                        <option value="{{ $programa->id }}">{{ $programa->nombre }}</option>
                        @endforeach
                    </x-adminlte-select>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="jornadaFicha" class="text-navy">Jornada</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jornadaFicha" value="Diurna" wire:model='jornada'>
                            <label class="form-check-label">Diurna</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jornadaFicha" value="Nocturna" wire:model='jornada'>
                            <label class="form-check-label">Nocturna</label>
                        </div>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="modalidadFicha" class="text-navy">Modalidad</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="modalidadFicha" value="Virtual" wire:model='modalidad'>
                            <label class="form-check-label">Virtual</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="modalidadFicha" value="Presencial" wire:model='modalidad'>
                            <label class="form-check-label">Presencial</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="inicioFicha" class="text-navy">Fecha de Inicio</label>
                        <input type="date" class="form-control" name="inicioFicha" wire:model='fechainicio'>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="finFicha" class="text-navy">Fecha de Finalización</label>
                        <input type="date" class="form-control" name="finFicha" wire:model='fechafin'>
                    </div>
                </div>
                <div class="row">
                    <x-adminlte-select name="instructorFicha" label="Gestor de Grupo" label-class="text-navy" fgroup-class="col-md-6" wire:model='instructor'>
                        @foreach ($instructores as $instructor)
                        <option value="{{ $instructor->id }}">{{ $instructor->nombre }} {{ $instructor->apellidos }}</option>
                        @endforeach
                    </x-adminlte-select>
                    <x-adminlte-input name="cantidadAprendices" label="Número de aprendices" label-class="text-navy" fgroup-class="col-md-6" wire:model='cantidad' />
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <x-adminlte-button class="btn-md" type="submit" label="Guardar" icon="fas fa-lg fa-save" class="bg-gradient-orange" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>