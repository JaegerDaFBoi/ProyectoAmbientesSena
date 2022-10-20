<div>
    <div class="card">
        <div class="card-header text-center bg-gradient-orange">
            <h4>Formulario para registro de programa de formación</h4>
        </div>
        <div class="card-body bg-gradient-gray">
            @if ($errors->any())
            <div class="alert alert-warning" role="alert">
                <p class="text-navy">Oops! Hay errores en el registro.</p>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form wire:submit.prevent='guardarPrograma' method="post">
                <div class="row">
                    <x-adminlte-input type="text" name="codigoPrograma" label="Código" label-class="text-navy" fgroup-class="col-md-6" wire:model='codigo' />
                </div>
                <div class="row">
                    <x-adminlte-input type="text" name="nombrePrograma" label="Nombre del Programa" label-class="text-navy" fgroup-class="col-md-10" wire:model='nombre' />
                </div>
                <div class="row">
                    <x-adminlte-input type="number" name="lectivaPrograma" label="Duración Etapa Lectiva" label-class="text-navy" fgroup-class="col-md-4" wire:model='duracionlectiva' />
                    <x-adminlte-input type="number" name="practicaPrograma" label="Duración Etapa Práctica" label-class="text-navy" fgroup-class="col-md-4" wire:model='duracionpractica' />
                </div>
                <div class="row">
                    <x-adminlte-input type="text" name="nivelformacionPrograma" label="Nivel de formación" label-class="text-navy" fgroup-class="col-md-8" wire:model='nivelformacion' />
                </div>
                <div class="row">
                    <x-adminlte-textarea name="perfilinstructorPrograma" label="Perfil del instructor" rows="8" col="40" label-class="text-navy" fgroup-class="col-md-6" wire:model='perfilinstructor' />
                    <x-adminlte-textarea name="descripcionPrograma" label="Descripción del programa" rows="8" col="40" label-class="text-navy" fgroup-class="col-md-6" wire:model='descripcion' />
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-block bg-gradient-orange">
                            <i class="fas fa-lg fa-save"></i>
                            Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>