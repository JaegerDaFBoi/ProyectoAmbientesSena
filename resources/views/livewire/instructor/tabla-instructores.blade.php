<div>
    <div class="row">
        @if ($infoInstructor)
        <div class="col-md-7">
            @else
            <div class="col-md-12 justify-self-center">
                @endif
            <div wire:ignore>
                <table id="tablaInstructores" class="table table-bordered table-dark table-striped table-hover table-responsive">
                    <thead>
                        <tr>
                            <th class="text-center text-orange">#</th>
                            <th class="text-orange">Nombre</th>
                            <th class="text-orange">Apellidos</th>
                            <th class="text-orange">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($instructores as $instructor)
                            <tr>
                                <td>{{ $instructor->id }}</td>
                                <td>{{ $instructor->nombre }}</td>
                                <td>{{ $instructor->apellidos }}</td>
                                <td>
                                    <button type="button" class="bg-gradient-navy" wire:click="setInstructor({{ $instructor->id }})">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <a href="{{ route('instructores.edit', $instructor) }}">
                                        <button type="button" class="bg-gradient-orange">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                    <button type="button" class="bg-gradient-danger" data-toggle="modal"
                                        data-target="#modalEliminar{{ $instructor->id }}">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                    <button type="button" class="bg-gradient-info">
                                        <a href="{{ route('instructores.horarios', $instructor) }}" style="color: #000000">Ver Horarios</a>
                                        <i class="fas fa-user-clock"></i>
                                    </button>
                                    
                                    <x-adminlte-modal id="modalEliminar{{ $instructor->id }}"
                                        title="Eliminar registro de instructor" size="md" theme="orange"
                                        static-backdrop>
                                        <h3 class="text-dark">¿Está seguro que desea eliminar este registro?</h3>
                                        <x-slot name="footerSlot">
                                            <form wire:submit.prevent="borrarInstructor({{ $instructor->id }})"
                                                method="post">
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
        </div>
        @if ($infoInstructor)
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-gradient-orange" >
                    <div class="row">
                        <div class="col-sm-10">
                            <h3 class="card-title text-dark">Información del instructor</h3>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="bg-gradient-danger" wire:click='cerrar'>
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-gradient-gray">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="text-navy">Nombre</label>
                            <p>{{ $nombre }} {{ $apellidos }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="text-navy">Cédula</label>
                            <p>{{ $cedula }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="text-navy">Correo Electrónico</label>
                            <p>{{ $email }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="text-navy">Area a la que pertenece</label>
                            <p>{{ $area }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="text-navy">Tipo de contrato</label>
                            <p>{{ $tipo }} - {{ $vinculacion }} </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="text-navy">Horas Semanales</label>
                            <p>{{ $horassemana }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function() {
            $('#tablaInstructores').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "scrollX": true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-MX.json'
                }
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
@endpush
