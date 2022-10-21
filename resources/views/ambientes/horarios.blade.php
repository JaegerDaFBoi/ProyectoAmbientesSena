@extends('adminlte::page')

@section('title', 'Ambientes')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-navy">Horarios Asignados</h1>
        <h2 class="m-0 text-navy">Ambiente de formación {{ $ambiente->nombre }}</h2>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
          <li class="breadcrumb-item"><a href="{{ route('ambientes.index') }}">Lista de Ambientes</a></li>
          <li class="breadcrumb-item active">Horarios</li>
        </ol>
      </div>
    </div>
  </div>
</div>
@stop

@section('content')
<div class="row mb-2">
  <div class="col-md-6">
    <a href="{{ route('ambientes.listahorarios', $ambiente) }}" class="btn btn-block bg-gradient-orange">Ir a Lista de Horarios para impresión</a>
  </div>
</div>
<livewire:asignacion.calendario-ambiente :events='$events' />
@stop