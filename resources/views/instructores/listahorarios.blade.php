@extends('adminlte::page')

@section('title', 'Instructores')

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-navy">Lista de Horarios</h1>
                    <h2 class="m-0 text-navy">Instructor {{ $instructor->nombre . ' ' . $instructor->apellidos }}</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('instructores.index') }}">Lista de Instructores</a>
                        </li>
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
                            <th>Tipo de Formacion</th>
                            <th>Fecha</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Ficha asignada</th>
                            <th>Ambiente Asignado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($eventosaMostrar as $evento)
                            <tr>
                                <td>{{ $evento['tipo'] }}</td>
                                <td>{{ $evento['fechaevento'] }}</td>
                                <td>{{ $evento['horainicio'] }}</td>
                                <td>{{ $evento['horafin'] }}</td>
                                <td>{{ $evento['numeroficha'] }}</td>
                                <td>{{ $evento['nombreambiente'] }}</td>
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
                    title: 'Instructor {{ $instructor->nombre . " " . $instructor->apellidos }}',
                    filename: 'Horarios {{ $instructor->nombre . " " . $instructor->apellidos }}'
                }],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-MX.json'
                }
            });
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
@endpush
