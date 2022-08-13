<div>
<div class="card">
        <div class="card-header text-center" style="background-color: #F05C12">
            <h4>Formulario para editar programa de formación</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-warning" role="alert">
                <p class="text-dark">Oops! Hay errores en el registro.</p>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form wire:submit.prevent='editarPrograma({{ $idprograma }})' method="post">
                <div class="row">
                    <x-adminlte-input type="text" name="codigoPrograma" label="Código" label-class="text-dark" fgroup-class="col-md-6" wire:model='codigo' />
                </div>
                <div class="row">
                    <x-adminlte-input type="text" name="nombrePrograma" label="Nombre del Programa" label-class="text-dark" fgroup-class="col-md-10" wire:model='nombre' />
                </div>
                <div class="row">
                    <x-adminlte-input type="number" name="lectivaPrograma" label="Duración Etapa Lectiva" label-class="text-dark" fgroup-class="col-md-4" wire:model='duracionlectiva' />
                    <x-adminlte-input type="number" name="practicaPrograma" label="Duración Etapa Práctica" label-class="text-dark" fgroup-class="col-md-4" wire:model='duracionpractica' />
                </div>
                <div class="row">
                    <x-adminlte-input type="text" name="nivelformacionPrograma" label="Nivel de formación" label-class="text-dark" fgroup-class="col-md-8" wire:model='nivelformacion' />
                </div>
                <div class="row">
                    <x-adminlte-textarea name="perfilinstructorPrograma" label="Perfil del instructor" rows="8" col="40" label-class="text-dark" fgroup-class="col-md-6" wire:model='perfilinstructor' />
                    <x-adminlte-textarea name="descripcionPrograma" label="Descripción del programa" rows="8" col="40" label-class="text-dark" fgroup-class="col-md-6" wire:model='descripcion' />
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-block" style="background-color: #F05C12">
                            <i class="fas fa-lg fa-save"></i>
                            Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
