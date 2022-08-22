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
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header" style="background-color: #F05C12">
          <h4>Formulario para registro de resultado de aprendizaje</h4>
        </div>
        <div class="card-body">
          @if ($errors->any())
          <div class="alert alert-warning" role="alert">
            <p class="text-dark">Oops! Hay errores en el registro.</p>
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <form action="{{ route('resultados.store', ['competencia' => $competencia, 'programa' => $programa]) }}" method="post">
            @csrf
            <div class="row">
              <div class="form-group col-md-6">
                <x-adminlte-textarea name="descripcionResultado" label="Descripción" rows="4" col="20" />
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="trimestreAsignacion">Trimestre de Asignación</label>
                <input type="number" id="trimestreAsignacion" name="trimestreAsignacion" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <label for="trimestreEvaluacion">Trimestre de Evaluación</label>
                <input type="number" id="trimestreEvaluacion" name="trimestreEvaluacion" class="form-control">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="horasSemanales">Horas Semanales</label>
                <input type="number" id="horasSemanales" name="horasSemanales" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <input type="hidden" name="competenciaResultado" value="{{ $competencia->id }}">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <button type="submit" class="btn btn-block" style="background-color: #F05C12;">
                  <i class="fas fa-lg fa-save"></i>
                  Guardar
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@stop