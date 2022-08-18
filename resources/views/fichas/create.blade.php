@extends('adminlte::page')
@section('plugins.TempusDominusBs4', true)

@section('title', 'Fichas')

@section('content_header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Fichas de Formación</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('fichas.index') }}">Lista de Fichas</a></li>
                    <li class="breadcrumb-item active">Crear Ficha</li>
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
                <div class="card-header text-center" style="background-color: #F05C12">
                    <h4>Formulario para registro de ficha de formación</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('fichas.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <x-adminlte-input name="numeroFicha" label="Número de ficha" fgroup-class="col-md-6" wire:model='numero' />
                            <x-adminlte-select name="programaFicha" label="Programa de formación" label-class="text-dark" fgroup-class="col-md-6">
                                @foreach ($programas as $programa)
                                <option value="{{ $programa->id }}">{{ $programa->nombre }}</option>
                                @endforeach
                            </x-adminlte-select>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="jornadaFicha">Jornada</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jornadaFicha" value="Diurna">
                                    <label class="form-check-label">Diurna</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jornadaFicha" value="Nocturna">
                                    <label class="form-check-label">Nocturna</label>
                                </div>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="modalidadFicha">Modalidad</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="modalidadFicha" value="Virtual">
                                    <label class="form-check-label">Virtual</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="modalidadFicha" value="Presencial">
                                    <label class="form-check-label">Presencial</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @php
                            $config = [
                            'format' => 'YYYY-MM-DD',
                            'dayViewHeaderFormat' => 'MMM YYYY',
                            ];
                            @endphp
                            <x-adminlte-input-date name="inicioFicha" label="Fecha de Inicio" igroup-size="md" :config="$config" fgroup-class="col-md-6">
                                <x-slot name="appendSlot">
                                    <div class="input-group-text bg-dark">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input-date>
                            <x-adminlte-input-date name="finalFicha" label="Fecha de Finalización" igroup-size="md" :config="$config" fgroup-class="col-md-6">
                                <x-slot name="appendSlot">
                                    <div class="input-group-text bg-dark">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input-date>
                        </div>
                        <div class="row">
                            <x-adminlte-select name="instructorFicha" label="Gestor de Grupo" label-class="text-dark" fgroup-class="col-md-6">
                                @foreach ($instructores as $instructor)
                                <option value="{{ $instructor->id }}">{{ $instructor->nombre }} {{ $instructor->apellidos }}</option>
                                @endforeach
                            </x-adminlte-select>
                            <x-adminlte-input name="cantidadAprendices" label="Número de aprendices" fgroup-class="col-md-6" />
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <x-adminlte-button class="btn-md" type="submit" label="Guardar" icon="fas fa-lg fa-save" style="background-color: #F05C12;" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop