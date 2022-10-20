@extends('adminlte::page')

@section('title', 'Programas')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-navy">Editar Programa</h1>
        <h1 class="m-0 text-navy">{{ $programa->nombre }}</h1>
        
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
          <li class="breadcrumb-item"><a href="{{ route('programas.index') }}">Lista de Programas</a></li>
          <li class="breadcrumb-item active">Editar Programa</li>
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
      <livewire:programa.editar-programa :programa='$programa' />
    </div>
  </div>
</div>
@stop