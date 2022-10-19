@extends('adminlte::page')

@section('title', 'Ambientes')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-navy">Ambientes de Formación</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
          <li class="breadcrumb-item active">Lista de Ambientes</li>
        </ol>
      </div>
    </div>
  </div>
</div>
@stop

@section('content')
<div class="container-fluid">

  <livewire:ambiente.crear-ambiente />

  <livewire:ambiente.tabla-ambientes :ambientes='$ambientes' />
</div>
@stop