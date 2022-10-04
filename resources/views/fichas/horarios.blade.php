@extends('adminlte::page')

@section('title', 'Fichas')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Horarios Asignados</h1>
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
<livewire:asignacion.calendario-ficha :events='$events' />
@stop