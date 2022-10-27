<div>
    <div class="row mb-3">
        <div class="col-md-6">
            <button type="button" class="btn btn-block btn-md bg-gradient-orange"
                wire:click='mostrarFormulario'>
                Registrar Asignaciones
            </button>
        </div>
    </div>
    @if ($formularioEvento)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-gradient-orange">
                        <h3 class="card-title text-navy">Datos de asignación</h3>
                    </div>
                    <div class="card-body bg-gradient-gray">
                        <div class="row">
                            <x-adminlte-select name="tipoAsignacion" id="tipoAsignacion" label="Tipo de Evento"
                                label-class="text-navy" fgroup-class="col-md-6" wire:model="tipo"
                                wire:change='cambiarFormulario'>
                                <option selected value="0">Seleccione...</option>
                                <option value="Titulada">Formación Titulada</option>
                                <option value="Complementaria">Formación Complementaria</option>
                                <option value="Adicionales">Horas Adicionales</option>
                            </x-adminlte-select>
                            <x-adminlte-select name="recurrencia" id="recurrencia" label="¿Desea registrar un evento recurrente?" label-class="text-navy" fgroup-class="col-md-3" wire:model="recurrencia">
                                <option disabled>Seleccione...</option>
                                <option value="1">SI</option>
                                <option value="2" selected >NO</option>
                            </x-adminlte-select>
                            @if ($recurrencia == 1)
                            <x-adminlte-input type="number" name="numSemanas" id="numSemanas"
                            label="Semanas a repetir evento" label-class="text-navy" fgroup-class="col-md-3" />
                            @endif
                        </div>
                        @if ($formularioTitulada)
                            <div class="row">
                                <x-adminlte-select name="fichaAsignacion" label="Ficha de formación"
                                    label-class="text-navy" fgroup-class="col-md-6" wire:model='fichaSeleccionada'
                                    wire:change='seleccionarPrograma'>
                                    <option selected value="0">Seleccione una ficha</option>
                                    @foreach ($fichas as $ficha)
                                        <option value="{{ $ficha->id }}">{{ $ficha->numero }}</option>
                                    @endforeach
                                </x-adminlte-select>
                                @if ($programaFormacion)
                                    <x-adminlte-input type="text" name="programaFormacion"
                                        label="Programa de Formación" label-class="text-navy" fgroup-class="col-md-6" disabled
                                        value="{{ $programaFormacion->nombre }}" />
                                @endif
                            </div>
                            @if ($programaFormacion)
                                <div class="row">
                                    <x-adminlte-select name="competenciaAsignacion" label="Competencia"
                                    label-class="text-navy" fgroup-class="col-md-6"
                                        wire:model='competenciaSeleccionada' wire:change='seleccionarResultados'>
                                        <option selected value="0">Seleccione una competencia</option>
                                        @foreach ($competencias as $competencia)
                                            <option value="{{ $competencia->id }}">{{ $competencia->codigo }}</option>
                                        @endforeach
                                    </x-adminlte-select>

                                    <x-adminlte-textarea name="descripcionCompetencia"
                                        label="Descripción de competencia" label-class="text-navy" fgroup-class="col-md-6" rows=2 disabled>
                                        @if ($competenciaSeleccionada)
                                            {{ $competenciaAsignacion->descripcion }}
                                        @endif
                                    </x-adminlte-textarea>
                                </div>
                                @if ($competenciaSeleccionada)
                                    <div class="row">
                                        <x-adminlte-select name="resultadoAsignacion" label="Resultado de Aprendizaje"
                                        label-class="text-navy" fgroup-class="col-md-6"
                                            wire:model='resultadoSeleccionado' wire:change='asignarResultado'>
                                            <option selected value="0">Seleccione un resultado</option>
                                            @foreach ($resultados as $resultado)
                                                <option value="{{ $resultado->id }}">{{ $resultado->descripcion }}
                                                </option>
                                            @endforeach
                                        </x-adminlte-select>

                                        <x-adminlte-textarea name="descripcionResultado"
                                            label="Descripción de resultado de aprendizaje" label-class="text-navy" fgroup-class="col-md-6"
                                            rows=2 disabled>
                                            @if ($resultadoSeleccionado)
                                                {{ $resultadoAsignacion->descripcion }}
                                            @endif
                                        </x-adminlte-textarea>
                                    </div>
                                @endif
                            @endif
                            <div class="row">
                                <x-adminlte-select name="instructorAsignacion" label="Instructor"
                                label-class="text-navy" fgroup-class="col-md-6" wire:model='instructorSeleccionado'>
                                    <option selected value="0">Seleccione un instructor</option>
                                    @foreach ($instructores as $instructor)
                                        <option value="{{ $instructor->id }}">{{ $instructor->nombre }}
                                            {{ $instructor->apellidos }}</option>
                                    @endforeach
                                </x-adminlte-select>
                                <x-adminlte-select name="ambienteAsignacion" label="Ambiente de Formación"
                                label-class="text-navy" fgroup-class="col-md-6" wire:model='ambienteSeleccionado'>
                                    <option selected value="0">Seleccione un ambiente</option>
                                    @foreach ($ambientes as $ambiente)
                                        <option value="{{ $ambiente->id }}">{{ $ambiente->nombre }}</option>
                                    @endforeach
                                </x-adminlte-select>
                            </div>
                            <div class="row">
                                <x-adminlte-textarea name="descripcionAsignacion" label="Descripción (Opcional)"
                                    rows="4" col="10" label-class="text-navy" fgroup-class="col-md-6" />
                            </div>
                        @elseif ($formularioOpcional)
                            <div class="row">
                                <x-adminlte-select name="instructorAsignacion" label="Instructor"
                                label-class="text-navy" fgroup-class="col-md-6" wire:model='instructorSeleccionado'>
                                    <option selected value="0">Seleccione un instructor</option>
                                    @foreach ($instructores as $instructor)
                                        <option value="{{ $instructor->id }}">{{ $instructor->nombre }}
                                            {{ $instructor->apellidos }}</option>
                                    @endforeach
                                </x-adminlte-select>
                                <x-adminlte-select name="ambienteAsignacion" label="Ambiente de Formación"
                                label-class="text-navy" fgroup-class="col-md-6" wire:model='ambienteSeleccionado'>
                                    <option selected value="0">Seleccione un ambiente</option>
                                    @foreach ($ambientes as $ambiente)
                                        <option value="{{ $ambiente->id }}">{{ $ambiente->nombre }}</option>
                                    @endforeach
                                </x-adminlte-select>
                            </div>
                            <div class="row">
                                <x-adminlte-input type="text" name="tituloEvento" id="tituloEvento"
                                    label="Titulo del evento" label-class="text-navy" fgroup-class="col-md-6" />
                                <x-adminlte-textarea name="descripcionEvento" label="Descripción (Opcional)"
                                    rows="4" col="10" label-class="text-navy" fgroup-class="col-md-6" />
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
