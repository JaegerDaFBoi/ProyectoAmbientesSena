<div>
    <div class="row">
        <div class="col-md-6">
            <table class="table table-bordered table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Número de Ficha</th>
                        <th>Cantidad de aprendices</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fichas as $ficha)
                    <tr>
                        <td>{{ $ficha->id }}</td>
                        <td>{{ $ficha->numero }}</td>
                        <td>{{ $ficha->cantidad }}</td>
                        <td>
                            <button type="button" wire:click="mostrar({{ $ficha->id }})">
                                <i class="fas fa-search"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background-color: #F05C12;">
                    <h3 class="card-title text-dark">Información de la ficha</h3>
                </div>
                <div class="card-body">
                    @if ($mostrarficha)
                    <div class="row">
                        <div class="col-md-12">
                            <label class="text-dark">Ficha # {{ $numero }}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="text-dark">Programa de formación asignado</label>
                            <p>{{ $programa }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="text-dark">Gestor de grupo</label>
                            <p>{{ $instructor }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="text-dark">Jornada asignada</label>
                            <p>{{ $jornada }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-dark">Modalidad de formación</label>
                            <p>{{ $modalidad }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="text-dark">Cantidad de Aprendices</label>
                            <p>{{ $cantidad }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="text-dark">Fecha de inicio</label>
                            <p>{{ $fechainicio }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-dark">Fecha de terminación</label>
                            <p>{{ $fechafin }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>