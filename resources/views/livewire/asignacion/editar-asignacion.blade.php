<div>
    <div class="card">
        <div class="card-header bg-gradient-navy">
            <h3 class="text-navy text-center">Formulario para editar asignación</h3>
            {{ $evento }}
        </div>
        <div class="card-body bg-gradient-gray">
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
                <x-adminlte-select name="resultadoAsignacion" label="Resultado de Aprendizaje" label-class="text-navy"
                    fgroup-class="col-md-6" wire:model='resultadoSeleccionado' wire:change='asignarResultado'>
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
        </div>
    </div>
</div>