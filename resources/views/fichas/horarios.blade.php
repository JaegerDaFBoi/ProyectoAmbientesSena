@extends('adminlte::page')

@section('title', 'Fichas')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-navy">Horarios Asignados</h1>
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
<div class="row mb-2">
  <div class="col-md-6">
    <a href="{{ route('fichas.listahorarios', $ficha) }}" class="btn btn-block bg-gradient-orange">Ir a Lista de Horarios para impresión</a>
  </div>
</div>
<livewire:asignacion.calendario-ficha :events='$events' />
@stop