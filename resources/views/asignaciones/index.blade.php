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
    <livewire:eventos.crear-evento />
</div>
@stop

@section('js')

@stop