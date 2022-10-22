<div>
    <div class="row mb-3">
        <div class="col-md-12">
            <table id="tablaAmbientes" class="table table-bordered table-dark table-striped table-hover">
                <thead>
                    <th class="text-center text-orange">#</th>
                    <th class="text-orange">Nombre</th>
                    <th class="text-orange">Tipo de Ambiente</th>
                    <th class="text-orange">Capacidad</th>
                    <th class="text-orange">Opciones</th>
                </thead>
                <tbody>
                    @foreach ($ambientes as $ambiente)
                        <tr>
                            <td>{{ $ambiente->id }}</td>
                            <td>{{ $ambiente->nombre }}</td>
                            <td>{{ $ambiente->tipo }}</td>
                            <td>{{ $ambiente->aforo }}</td>
                            <td>
                                <button type="button" class="bg-gradient-orange"
                                    wire:click='mostrarEdicion({{ $ambiente->id }})'>
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="bg-gradient-info">
                                    <a href="{{ route('ambientes.horarios', $ambiente) }}" style="color: #000000">Ver
                                        Horarios</a>
                                    <i class="fas fa-user-clock"></i>
                                </button>
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
                    <div class="card-header justify-content-center bg-gradient-orange">
                        <h4 class="card-title text-navy">Modificación de Ambiente</h4>
                    </div>
                    <div class="card-body bg-gradient-gray">
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
                                <label for="ambienteNombre" class="text-navy">Nombre del Ambiente</label>
                                <input type="text" class="form-control" id="ambienteNombre" name="ambienteNombre"
                                    wire:model='nombre'>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="tipoAmbiente" class="text-navy">Tipo de Ambiente</label>
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
                                    <label for="ambienteAforo" class="text-navy">Capacidad</label>
                                    <input type="number" class="form-control" id="ambienteAforo" name="ambienteAforo"
                                        wire:model='aforo'>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-block bg-gradient-orange">
                                        <i class="fas fa-lg fa-save"></i>
                                        Guardar
                                    </button>
                                </div>
                                <div class="col-sm-2 float-right">
                                    <button type="button" class="btn btn-block bg-gradient-orange" wire:click='cerrar'>
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

    @push('js')
    <script>
        $(document).ready(function() {
            $('#tablaAmbientes').DataTable({
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
</div>
