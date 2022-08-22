@extends('adminlte::page')

@section('title', 'Resultados')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Crear Resultado de Aprendizaje Competencia {{ $competencia->codigo }}</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
          <li class="breadcrumb-item"><a href="{{ route('competencias.index', ['idprograma' => $programa->id ]) }}">Lista de Competencias</a></li>
          <li class="breadcrumb-item active">Crear Resultado de Aprendizaje</li>
        </ol>
      </div>
    </div>
  </div>
</div>
@stop

@section('content')

@stop