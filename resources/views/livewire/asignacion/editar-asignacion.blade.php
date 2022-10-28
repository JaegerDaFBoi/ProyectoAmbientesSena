<div>
    <div class="row">
        <x-adminlte-input type="text" name="tipoAsignacion" label="Tipo de Asignación" label-class="text-navy"
            fgroup-class="col-md-6" disabled wire:model="tipoAsignacion" />
    </div>
    @if ($tipoAsignacion == 'Titulada')
        <div class="row">
            <x-adminlte-select name="fichaAsignacion" label="Ficha de formación" label-class="text-navy"
                fgroup-class="col-md-6" wire:model='fichaSeleccionada' wire:change='seleccionarPrograma'>
                <option selected value="0">Seleccione una ficha</option>
                @foreach ($fichas as $ficha)
                    <option value="{{ $ficha->id }}">{{ $ficha->numero }}</option>
                @endforeach
            </x-adminlte-select>
            @if ($programaFormacion)
                <x-adminlte-input type="text" name="programaFormacion" label="Programa de Formación"
                    label-class="text-navy" fgroup-class="col-md-6" disabled value="{{ $programaFormacion->nombre }}" />
            @endif
        </div>
        @if ($programaFormacion)
            <div class="row">
                <x-adminlte-select name="competenciaAsignacion" label="Competencia" label-class="text-navy"
                    fgroup-class="col-md-6" wire:model='competenciaSeleccionada' wire:change='seleccionarResultados'>
                    <option selected value="0">Seleccione una competencia</option>
                    @foreach ($competencias as $competencia)
                        <option value="{{ $competencia->id }}">{{ $competencia->codigo }}</option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-textarea name="descripcionCompetencia" label="Descripción de competencia"
                    label-class="text-navy" fgroup-class="col-md-6" rows=2 disabled>
                    @if ($competenciaSeleccionada)
                        {{ $competenciaAsignacion->descripcion }}
                    @endif
                </x-adminlte-textarea>
            </div>
            @if ($competenciaSeleccionada)
                <div class="row">
                    <x-adminlte-select name="resultadoAsignacion" label="Resultado de Aprendizaje"
                        label-class="text-navy" fgroup-class="col-md-6" wire:model='resultadoSeleccionado'
                        wire:change='asignarResultado'>
                        <option selected value="0">Seleccione un resultado</option>
                        @foreach ($resultados as $resultado)
                            <option value="{{ $resultado->id }}">{{ $resultado->descripcion }}
                            </option>
                        @endforeach
                    </x-adminlte-select>

                    <x-adminlte-textarea name="descripcionResultado" label="Descripción de resultado de aprendizaje"
                        label-class="text-navy" fgroup-class="col-md-6" rows=2 disabled>
                        @if ($resultadoSeleccionado)
                            {{ $resultadoAsignacion->descripcion }}
                        @endif
                    </x-adminlte-textarea>
                </div>
            @endif
        @endif
    @else
        <div class="row">
            <x-adminlte-input type="text" name="tituloEvento" id="tituloEvento" label="Titulo del evento"
                label-class="text-navy" fgroup-class="col-md-6" wire:model='tituloEvento' />
        </div>
    @endif
    <x-adminlte-textarea name="descripcionEvento" label="Descripción (Opcional)" rows="4" col="10"
        label-class="text-navy" fgroup-class="col-md-6" wire:model='descripcionEvento' />

    <div class="row">
        <x-adminlte-select name="instructorAsignacion" label="Instructor" label-class="text-navy"
            fgroup-class="col-md-6" wire:model="instructorSeleccionado">
            <option value="0">Seleccione un instructor...</option>
            @foreach ($instructores as $instructor)
                <option value="{{ $instructor->id }}">{{ $instructor->nombre }} {{ $instructor->apellidos }}</option>
            @endforeach
        </x-adminlte-select>
        <x-adminlte-select name="ambienteAsignacion" label="Ambiente de Formación" label-class="text-navy"
            fgroup-class="col-md-6" wire:model='ambienteSeleccionado'>
            <option selected value="0">Seleccione un ambiente</option>
            @foreach ($ambientes as $ambiente)
                <option value="{{ $ambiente->id }}">{{ $ambiente->nombre }}</option>
            @endforeach
        </x-adminlte-select>
    </div>

</div>
