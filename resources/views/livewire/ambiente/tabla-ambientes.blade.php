<div>
    <div class="row mb-3">
        <div class="col-md-12">
            <table class="table table-bordered table-dark table-striped table-hover">
                <thead>
                    <th class="text-center">#</th>
                    <th>Nombre</th>
                    <th>Tipo de Ambiente</th>
                    <th>Capacidad</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    @foreach ($ambientes as $ambiente)
                        <tr>
                            <td>{{ $ambiente->id }}</td>
                            <td>{{ $ambiente->nombre }}</td>
                            <td>{{ $ambiente->tipo }}</td>
                            <td>{{ $ambiente->aforo }}</td>
                            <td>
                                <button type="button" wire:click='mostrarEdicion({{ $ambiente->id }})'>
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="{{ route('ambientes.horarios', $ambiente) }}">Ver Horarios</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if ($mostrar)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-center" style="background-color: #F05C12;">
                        <h4 class="card-title">Modificación de Ambiente</h4>
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
                        <form wire:submit.prevent='editarAmbiente' method="post">
                            <div class="form-group">
                                <label for="ambienteNombre" class="text-dark">Nombre del Ambiente</label>
                                <input type="text" class="form-control" id="ambienteNombre" name="ambienteNombre"
                                    wire:model='nombre'>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="tipoAmbiente">Tipo de Ambiente</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipoAmbiente"
                                            value="Virtual" wire:model='tipo'>
                                        <label class="form-check-label">Virtual</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipoAmbiente"
                                            value="Presencial" wire:model='tipo'>
                                        <label class="form-check-label">Presencial</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="ambienteAforo">Capacidad</label>
                                    <input type="number" class="form-control" id="ambienteAforo" name="ambienteAforo"
                                        wire:model='aforo'>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-block" style="background-color: #F05C12;">
                                        <i class="fas fa-lg fa-save"></i>
                                        Guardar
                                    </button>
                                </div>
                                <div class="col-sm-2 float-right">
                                    <button type="button" class="btn btn-block" wire:click='cerrar'
                                        style="background-color: #F05C12;">
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
