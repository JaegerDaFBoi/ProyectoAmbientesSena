<div>
    <div class="row mb-3">
        <div class="col-md-6">
            <button type="button" class="btn btn-block bg-gradient-orange" wire:click='mostrar'>
                <i class="fas fa-plus"></i>
                Añadir Ambiente
            </button>
        </div>
    </div>
    @if ($mostrarFormulario)
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header justify-content-center bg-gradient-orange">
                    <h4 class="card-title text-navy">Datos de Ambiente</h4>
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
                    <form wire:submit.prevent='guardarAmbiente' method="post">
                        <div class="form-group">
                            <label for="ambienteNombre" class="text-navy">Nombre del Ambiente</label>
                            <input type="text" class="form-control" id="ambienteNombre" name="ambienteNombre" wire:model='nombre'>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="tipoAmbiente" class="text-navy">Tipo de Ambiente</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipoAmbiente" value="Virtual" wire:model='tipo'>
                                    <label class="form-check-label">Virtual</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipoAmbiente" value="Presencial" wire:model='tipo'>
                                    <label class="form-check-label">Presencial</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="ambienteAforo" class="text-navy">Capacidad</label>
                                <input type="number" class="form-control" id="ambienteAforo" name="ambienteAforo" wire:model='aforo'>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-block bg-gradient-orange" style="background-color: #F05C12;">
                                    <i class="fas fa-lg fa-save"></i>
                                    Guardar
                                </button>
                            </div>
                            <div class="col-sm-2 float-right">
                                <button type="button" class="btn btn-block bg-gradient-orange" wire:click='cerrar' style="background-color: #F05C12;">
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