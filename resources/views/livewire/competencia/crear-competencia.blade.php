<div>
    <div class="row mb-3">
        <div class="col-md-4">
            <button type="button" class="btn btn-block btn-md" style="background-color: #F05C12;" wire:click='mostrarFormulario'>
                Añadir Competencia
            </button>
        </div>
    </div>
    @if ($mostrar)
    <div class="row mb-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header justify-content-center" style="background-color: #F05C12;">
                    <h4 class="card-title">Datos de Competencia</h4>
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
                    <form wire:submit.prevent='guardarCompetencia' method="post">
                        <input type="hidden" value="{{ $programa->id }}" wire:model='idprograma'>
                        <div class="form-group col-md-6">
                            <label for="codigoCompetencia">Código</label>
                            <input type="text" class="form-control" id="codigoCompetencia" name="codigoCompetencia" wire:model='codigo'>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <x-adminlte-textarea name="descripcionCompetencia" label="Descripción" rows="8" col="40" label-class="text-dark" wire:model='descripcion' />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-block" style="background-color: #F05C12;">
                                    <i class="fas fa-lg fa-save"></i>
                                    Guardar
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-block" wire:click='cerrar' style="background-color: #F05C12;">
                                    Cerrar
                                </button>   
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>