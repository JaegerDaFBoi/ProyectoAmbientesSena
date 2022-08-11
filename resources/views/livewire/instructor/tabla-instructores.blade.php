<div>
    <div class="row">
        <div class="col-md-7">
            <table class="table table-bordered table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($instructores as $instructor)
                    <tr>
                        <td>{{ $instructor->id }}</td>
                        <td>{{ $instructor->nombre }}</td>
                        <td>{{ $instructor->apellidos }}</td>
                        <td>
                            <button type="button" wire:click="setInstructor({{ $instructor->id }})">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('instructores.edit', $instructor) }}">
                                <button type="button">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </a>
                            <button type="button" data-toggle="modal" data-target="#modalEliminar{{ $instructor->id }}">
                                <i class="far fa-trash-alt"></i>
                            </button>
                            <x-adminlte-modal id="modalEliminar{{ $instructor->id }}" title="Eliminar registro de instructor" size="md" theme="orange" static-backdrop>
                                <h3 class="text-dark">¿Está seguro que desea eliminar este registro?</h3>
                                <x-slot name="footerSlot">
                                    <form wire:submit.prevent="borrarInstructor({{ $instructor->id }})" method="post">
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
        <div class="col-md-5">
            <div class="card">
                <div class="card-header" style="background-color: #F05C12;">
                    <h3 class="card-title text-dark">Información del instructor</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="text-dark">Nombre</label>
                            <p>{{ $nombre }} {{ $apellidos }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="text-dark">Cédula</label>
                            <p>{{ $cedula }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="text-dark">Correo Electrónico</label>
                            <p>{{ $email }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="text-dark">Area a la que pertenece</label>
                            <p>{{ $area }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="text-dark">Tipo de contrato</label>
                            <p>{{ $tipo }} - {{ $vinculacion }} </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="text-dark">Horas Semanales</label>
                            <p>{{ $horassemana }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>