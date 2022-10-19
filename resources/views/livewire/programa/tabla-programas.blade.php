<div>
    <div class="row">
        @if(!$info)
        <div class="col-md-12">
            @else
            <div class="col-md-4">
                @endif
                <table class="table table-bordered table-dark table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center text-orange">#</th>
                            <th class="text-orange">Código</th>
                            @if(!$info)
                            <th class="text-orange">Nombre</th>
                            <th class="text-orange">Nivel de Formación</th>
                            @endif
                            <th class="text-orange">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($programas as $programa)
                        <tr>
                            <td>{{ $programa->id }}</td>
                            <td>{{ $programa->codigo }}</td>
                            @if(!$info)
                            <td>{{ $programa->nombre }}</td>
                            <td>{{ $programa->nivelformacion }}</td>
                            @endif
                            <td>
                                <button type="button" class="bg-gradient-navy" wire:click="mostrarInfo({{ $programa->id }})">
                                    <i class="fas fa-search"></i>
                                </button>
                                <a href="{{ route('programas.edit', $programa) }}">
                                    <button type="button" class="bg-gradient-orange">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </a>
                                <button type="button" class="bg-gradient-danger" data-toggle="modal" data-target="#modalEliminar{{ $programa->id }}">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                                <x-adminlte-modal id="modalEliminar{{ $programa->id }}" title="Eliminar programa de formación" size="md" theme="orange" static-backdrop>
                                    <h3 class="text-dark">¿Está seguro que desea eliminar este registro?</h3>
                                    <x-slot name="footerSlot">
                                        <form wire:submit.prevent="borrarPrograma({{ $programa->id }})" method="post">
                                            <button type="submit" class="btn btn-block" style="background-color: #F05C12;">
                                                Eliminar
                                            </button>
                                        </form>
                                    </x-slot>
                                </x-adminlte-modal>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($info)
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="background-color: #F05C12;">
                        <div class="row">
                            <div class="col-md-10">
                                <h3 class="card-title text-dark">Detalle del programa de formación {{ $codigo }} </h3>
                            </div>
                            <div class="col-md-2">
                                <button type="button" wire:click='cerrar'>
                                    <i class="fas fa-window-close"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <h5 class="text-dark">{{ $nombre }}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="text-dark">Nivel de formación</label>
                                <p>{{ $nivelformacion }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="text-dark">Descripción del programa</label>
                                <p>{{ $descripcion }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="text-dark">Perfil del instructor</label>
                                <p>{{ $perfilinstructor }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label class="text-dark">Duración de etapa lectiva</label>
                                <p>{{ $duracionlectiva }} meses</p>
                            </div>
                            <div class="col-md-4">
                                <label class="text-dark">Duración de etapa práctica</label>
                                <p>{{ $duracionpractica }} meses</p>
                            </div>
                            <div class="col-md-4">
                                <label class="text-dark">Total de trimestres</label>
                                <p>{{ $totaltrimestres}} trimestres</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('competencias.index', $idprograma) }}">Ver Competencias asociadas</a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>