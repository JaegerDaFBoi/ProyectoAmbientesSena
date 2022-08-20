@extends('adminlte::page')

@section('title', 'Competencias')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Competencias de Programa {{ $programa->nombre }}</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
          <li class="breadcrumb-item active">Lista de Competencias</li>
        </ol>
      </div>
    </div>
  </div>
</div>
@stop

@section('content')
<div class="container-fluid">
  <div class="row mb-3">
    <div class="col-md-4">
      <a href="{{ route('fichas.create') }}">
        <button type="button" class="btn btn-block btn-md" style="background-color: #F05C12;">
          
        </button>
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <livewire:competencia.tabla-competencias :programa="$programa" />
    </div>
  </div>
</div>
@stop