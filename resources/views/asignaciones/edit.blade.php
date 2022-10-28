@extends('adminlte::page')

@section('title', 'Eventos')

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-navy">Editar Asignación</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Editar Asignación</li>
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
                <div class="card">
                    @if (session('message'))
                        <x-adminlte-alert class="bg-gradient-orange" icon="fas fa-exclamation-triangle" title="Atención!"
                            dismissable>
                            {{ session('message') }}
                        </x-adminlte-alert>
                    @endif
                    <div class="card-header bg-gradient-orange">
                        <h3>Formulario para edición de asignaciones</h3>
                    </div>
                    <div class="card-body bg-gradient-gray">
                        <form action="{{ route('eventos.update', $idevento) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <livewire:asignacion.editar-asignacion :idevento="$idevento" />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fechaInicio" class="text-navy">Inicio de evento</label>
                                        <div class="input-group date" id="fechaInicio" data-target-input="nearest">
                                            <input type="text" name="fechaInicio"
                                                class="form-control datetimepicker-input" data-target="#fechaInicio"
                                                value="{{ $fechainicio }}" />
                                            <div class="input-group-append" data-target="#fechaInicio"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fechaFin" class="text-navy">Fin de evento</label>
                                        <div class="input-group date" id="fechaFin" data-target-input="nearest">
                                            <input type="text" name="fechaFin" class="form-control datetimepicker-input"
                                                data-target="#fechaFin" value="{{ $fechafin }}" />
                                            <div class="input-group-append" data-target="#fechaFin"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-sm bg-gradient-orange">
                                        Actualizar Evento
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        $(document).ready(function() {
            var now = moment();
            $('#fechaInicio').datetimepicker({
                format: 'YYYY-MM-DD HH:mm',
                icons: {
                    time: 'fas fa-clock'
                },
                useCurrent: true,
                locale: 'es-mx.js',

            });
        });

        $(document).ready(function() {
            var now = moment();
            $('#fechaFin').datetimepicker({
                format: 'YYYY-MM-DD HH:mm',
                icons: {
                    time: 'fas fa-clock'
                },
                useCurrent: true,
                locale: 'es-mx.js',

            });
        });
    </script>
@endpush
