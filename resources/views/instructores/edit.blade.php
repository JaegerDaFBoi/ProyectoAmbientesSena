@extends('adminlte::page')

@section('title', 'Editar Instructor')

@section('content_header')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-navy">Editar Instructor</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Editar Instructor</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
@stop

@section('content')

<livewire:instructor.editar-instructor :instructor='$instructor' />

@stop