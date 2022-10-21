@extends('adminlte::page')

@section('title', 'Fichas')

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-navy">Lista de Horarios</h1>
                    <h2 class="m-0 text-navy">Ficha de formación # {{ $ficha->numero }}</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('fichas.index') }}">Lista de Fichas</a></li>
                        <li class="breadcrumb-item active">Horarios</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <table id="listaEventos" class="table table-dark table-hover table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Instructor asignado</th>
                            <th>Ambiente Asignado</th>
                            <th>Codigo de Competencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($eventosaMostrar as $evento)
                            <tr>
                                <td>{{ $evento['fechaevento'] }}</td>
                                <td>{{ $evento['horainicio'] }}</td>
                                <td>{{ $evento['horafin'] }}</td>
                                <td>{{ $evento['nombreinstructor'] }}</td>
                                <td>{{ $evento['nombreambiente'] }}</td>
                                <td>{{ $evento['codigocompetencia'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        $(document).ready(function() {
            $('#listaEventos').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "scrollX": true,
                dom: 'Bfrtilp',
                buttons: [{
                    extend: 'pdfHtml5',
                    text: 'Exportar a PDF',
                    titleAttr: 'Exportar a PDF',
                    className: 'btn bg-gradient-navy',
                    title: 'Ficha de formación # {{ $ficha->numero }}',
                    filename: 'Horarios {{ $ficha->numero }}'
                }],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-MX.json'
                }
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
@endpush
