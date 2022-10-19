@extends('adminlte::page')

@section('title', 'Instructores')

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-navy">Lista de Instructores</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Lista de Instructores</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-2">
                <a href="{{ route('instructores.create') }}">
                    <button type="button" class="btn btn-block bg-gradient-orange btn-md">
                        Crear Instructor
                    </button>
                </a>
            </div>
        </div>
        @if (session('message'))
            <x-adminlte-alert class="bg-gradient-orange" icon="fa fa-lg fa-thumbs-up" title="Hecho!" dismissable>
                {{ session('message') }}
            </x-adminlte-alert>
        @endif
        <div class="row">
            <div class="col-md-12">
                {{-- Componente para tabla de instructores e informacion detallada --}}
                <livewire:instructor.tabla-instructores />
            </div>
        </div>
    </div>
@stop
