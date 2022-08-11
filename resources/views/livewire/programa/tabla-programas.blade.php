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
                            <th class="text-center">#</th>
                            <th>Código</th>
                            @if(!$info)
                            <th>Nombre</th>
                            <th>Nivel de Formación</th>
                            @endif
                            <th>Opciones</th>
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
                                <button type="button" wire:click="mostrarInfo({{ $programa->id }})">
                                    <i class="fas fa-search"></i>
                                </button>
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
                                <h3 class="card-title text-dark">Detalle del programa de formación</h3>
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
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>