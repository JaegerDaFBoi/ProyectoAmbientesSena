<div>

    <div class="row">
        <div class="col-md-8">
            <table class="table table-bordered table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Codigo</th>
                        <th>Descripción</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($competencias as $competencia)
                        <tr>
                            <td>{{ $competencia->id }}</td>
                            <td>{{ $competencia->codigo }}</td>
                            <td>{{ $competencia->descripcion }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
