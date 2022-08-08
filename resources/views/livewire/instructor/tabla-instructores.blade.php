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