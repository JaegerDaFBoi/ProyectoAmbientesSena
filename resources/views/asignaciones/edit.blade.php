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
                <div class="card-header bg-gradient-orange">
                    <h3>Formulario para edición de evento</h3>
                </div>
                <div class="card-body bg-gradient-gray">
                    <livewire:asignacion.editar-asignacion :idevento="$idevento" />
                </div>
            </div>
        </div>
    </div>
</div>
@stop