@extends('adminlte::page')

@section('title', 'Eventos')

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Asignaciones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Lista de Asignaciones</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <form action="{{ route('eventos.store') }}" method="post">
            @csrf
            <livewire:eventos.crear-evento />
            @if (session('message'))
                <x-adminlte-alert class="bg-orange" icon="fa fa-lg fa-thumbs-up" title="Hecho!" dismissable>
                    {{ session('message') }}
                </x-adminlte-alert>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #F05C12;">
                            <h3 class="card-title">Datos del evento</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fechaInicio">Inicio de evento</label>
                                        <div class="input-group date" id="fechaInicio" data-target-input="nearest">
                                            <input type="text" name="fechaInicio"
                                                class="form-control datetimepicker-input" data-target="#fechaInicio" />
                                            <div class="input-group-append" data-target="#fechaInicio"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fechaFin">Fin de evento</label>
                                        <div class="input-group date" id="fechaFin" data-target-input="nearest">
                                            <input type="text" name="fechaFin" class="form-control datetimepicker-input"
                                                data-target="#fechaFin" />
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
                                    <button type="submit" class="btn btn-sm" style="background-color: #F05C12;">
                                        Guardar Evento
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div id="calendar">

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
                minDate: now,
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
                minDate: now,
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                headerToolbar: {
                    left: 'prev,next,today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,dayGridDay'
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Dia'
                },
                navLinks: true,
                events: {
                    url: '{{ route('eventos.show') }}'
                }
            });
            calendar.render();
        });
    </script>
@endpush
