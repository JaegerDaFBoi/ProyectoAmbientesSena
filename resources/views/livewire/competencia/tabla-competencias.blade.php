<div>
    <div class="row">
        @if (!$mostrarEditar)
            <div class="col-md-8">
            @elseif($mostrarEditar)
                <div class="col-md-6">
        @endif
        <table class="table table-bordered table-dark table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Codigo</th>
                    @if (!$mostrarEditar)
                        <th>Descripción</th>
                    @endif
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($competencias as $competencia)
                    <tr>
                        <td>{{ $competencia->id }}</td>
                        <td>{{ $competencia->codigo }}</td>
                        @if (!$mostrarEditar)
                            <td>{{ $competencia->descripcion }}</td>
                        @endif
                        <td>
                            <button type="button" wire:click='mostrarEditar({{ $competencia->id }})'>
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" data-toggle="modal" data-target="#modalEliminar{{ $competencia->id }}">
                                <i class="far fa-trash-alt"></i>
                            </button>
                            <x-adminlte-modal id="modalEliminar{{ $competencia->id }}" title="Eliminar competencia"
                                size="md" theme="orange" static-backdrop>
                                <h3 class="text-dark">¿Está seguro que desea eliminar este registro?</h3>
                                <x-slot name="footerSlot">
                                    <form wire:submit.prevent="borrarCompetencia({{ $competencia->id }})"
                                        method="post">
                                        <button type="submit" class="btn btn-block" style="background-color: #F05C12;">
                                            Eliminar
                                        </button>
                                    </form>
                                </x-slot>
                            </x-adminlte-modal>
                        </td>
                        <td>
                            <button type="button" class="btn btn-block" style="background-color: #F05C12;" wire:click='mostrarResultados({{ $competencia->id }})'>
                                Resultados de Aprendizaje
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($mostrarEditar)
        <div class="col-md-6">
            <div class="card">
                <div class="card-header justify-content-center" style="background-color: #F05C12;">
                    <h4 class="card-title">Editar Competencia</h4>
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
                            <input type="text" class="form-control" id="codigoCompetencia" name="codigoCompetencia"
                                wire:model='codigo'>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <x-adminlte-textarea name="descripcionCompetencia" label="Descripción" rows="4"
                                    col="20" label-class="text-dark" wire:model='descripcion' />
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
    @endif
    </div>
    @if ($mostrarResultados)
    <div class="row mt-2">
        <div class="col-md-4">
            <a href="{{ route('resultados.create', ['idcompetencia' => $idcompetencia]) }}">
                <button type="button" class="btn btn-block" style="background-color: #F05C12;">
                    Añadir Resultado
                </button>
            </a>
        </div>
    </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: #F05C12;">
                        <h4 class="text-dark">Resultados de Aprendizaje Competencia {{ $codigo }}</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Descripción</th>
                                    <th>Trimestre de Asignación</th>
                                    <th>Trimestre de Evaluación</th>
                                    <th>Horas Semanales</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
