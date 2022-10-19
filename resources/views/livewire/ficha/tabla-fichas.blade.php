<div>
    <div class="row">
        <div class="col-md-6">
            <table class="table table-bordered table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center text-orange">#</th>
                        <th class="text-orange">Número de Ficha</th>
                        <th class="text-orange">Cantidad de aprendices</th>
                        <th class="text-orange">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fichas as $ficha)
                    <tr>
                        <td>{{ $ficha->id }}</td>
                        <td>{{ $ficha->numero }}</td>
                        <td>{{ $ficha->cantidad }}</td>
                        <td>
                            <button type="button" class="bg-gradient-navy" wire:click="mostrar({{ $ficha->id }})">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('fichas.edit', $ficha) }}">
                                <button type="button" class="bg-gradient-orange">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </a>
                            <button type="button" class="bg-gradient-danger" data-toggle="modal" data-target="#modalEliminar{{ $ficha->id }}">
                                <i class="far fa-trash-alt"></i>
                            </button>
                            <button type="button" class="bg-gradient-info">
                                <a href="{{ route('fichas.horarios', $ficha) }}" style="color: #000000">Ver Horarios</a>
                                <i class="fas fa-user-clock"></i>
                            </button>
                            <x-adminlte-modal id="modalEliminar{{ $ficha->id }}" title="Eliminar registro de instructor" size="md" theme="orange" static-backdrop>
                                <h3 class="text-dark">¿Está seguro que desea eliminar este registro?</h3>
                                <x-slot name="footerSlot">
                                    <form wire:submit.prevent="eliminarFicha({{ $ficha->id }})" method="post">
                                        <button type="submit" class="btn btn-block bg-gradient-orange">
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
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-gradient-orange">
                    <h3 class="card-title text-navy">Información de la ficha</h3>
                </div>
                <div class="card-body bg-gradient-gray">
                    @if ($mostrarficha)
                    <div class="row">
                        <div class="col-md-12">
                            <label class="text-navy">Ficha # {{ $numero }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="text-navy">Programa de formación asignado</label>
                            <p>{{ $programa }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="text-navy">Gestor de grupo</label>
                            <p>{{ $instructor }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="text-navy">Jornada asignada</label>
                            <p>{{ $jornada }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-navy">Modalidad de formación</label>
                            <p>{{ $modalidad }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="text-navy">Cantidad de Aprendices</label>
                            <p>{{ $cantidad }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="text-navy">Fecha de inicio</label>
                            <p>{{ $fechainicio }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-navy">Fecha de terminación</label>
                            <p>{{ $fechafin }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>