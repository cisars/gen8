{{'<?php'}}
{{--CONFIGURACION--}}
@php
    $NOMBRES  = $gen->tabla['ZNOMBRESZ'] ;
    $NOMBRE   = $gen->tabla['ZNOMBREZ'] ;
    $nombres  = $gen->tabla['ZnombresZ'] ;
    $nombre   = $gen->tabla['ZnombreZ'] ;
// GENISA Begin
@endphp
/** @var \Illuminate\Database\Eloquent\Factory $factory */

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition()
    {
        return [
@foreach ($gen->tabla['columnas'] as $dataCol)
@if ($dataCol['cardinalidad'] == 'pk' )
//{{ $dataCol['nombre'] }}
@endif
@if ($dataCol['tipo'] == 'enum' )
@php
$auxcons = '';
$coma = '';
@endphp
@foreach ($gen->tabla['enumCol'] as $dataEnum)
@if( $dataEnum['nombre'] == $dataCol['nombre'] )
@php
$auxcons = $auxcons.$coma."'".$dataEnum['key']."'";
$coma = ',';
@endphp
@endif
@endforeach
            '{{$dataCol['nombre']}}' => $this->faker->randomElement([{{ $auxcons  }}]),
@endif
@if ($dataCol['cardinalidad'] == 'cons' )
@php
$auxcons = '';
$coma = '';
@endphp
@foreach ($gen->tabla['constantes'] as $dataCons)
@if( $dataCons['nombre'] == $dataCol['nombre'] )
@php
$auxcons = $auxcons.$coma."'".$dataCons['valor']."'";
$coma = ',';
@endphp
@endif
@endforeach
            '{{$dataCol['nombre']}}' => $this->faker->randomElement([{{ $auxcons  }}]),
@endif
@if($dataCol['cardinalidad'] == 'fk'  || $dataCol['cardinalidad'] == 'pkfk')
            '{{$dataCol['nombre']}}'  => \App\Models\{{$dataCol['FK']}}::inRandomOrder()->first()->id,
@endif
@if( ($dataCol['tipo'] == 'int' || $dataCol['tipo'] == 'numeric' || $dataCol['tipo'] == 'smallint' || $dataCol['tipo'] == 'tinyint' ) && $dataCol['cardinalidad'] == '')
@php
$iniaux = 1;
$finaux = 9;
@endphp
@for ($i = 1; $i < $dataCol['longitud']; $i++)
@php
$iniaux = $iniaux.'0';
$finaux = $finaux.'9';
@endphp
@endfor
@if( ($dataCol['tipo'] == 'tinyint' ))
            '{{$dataCol['nombre']}}' => $this->faker->numberBetween({{ 0 }} ,{{ 255 }} ),
@endif
@if( ($dataCol['tipo'] == 'smallint' ))
            '{{$dataCol['nombre']}}' => $this->faker->numberBetween({{ 0 }} ,{{ 32767 }} ),
@endif
@if( ($dataCol['tipo'] == 'int' ))
            '{{$dataCol['nombre']}}' => $this->faker->numberBetween({{ 0 }} ,{{ 2147483647 }} ),
@endif
@if( ($dataCol['tipo'] == 'bigint' ))
            '{{$dataCol['nombre']}}' => $this->faker->numberBetween({{ 0 }} ,{{ 9223372036854775807 }} ),
@endif
@if( ($dataCol['tipo'] == 'numeric' ))
            '{{$dataCol['nombre']}}' => $this->faker->numberBetween({{ $iniaux }} ,{{ $finaux }} ),
@endif
@endif
@if ( ($dataCol['tipo'] == 'varchar' || $dataCol['tipo'] == 'text' || $dataCol['tipo'] == 'char') && $dataCol['cardinalidad'] == '')
            '{{$dataCol['nombre']}}' => $this->faker->text({{ $dataCol['longitud']}}),
@endif
@if ($dataCol['tipo'] == 'date'  && $dataCol['cardinalidad'] == '')
            '{{$dataCol['nombre']}}' => $this->faker->dateTimeBetween('-50 years', '-20 years' ),
@endif
@if (  $dataCol['tipo'] == 'timestamp' && $dataCol['cardinalidad'] == '')
            '{{$dataCol['nombre']}}' => $this->faker->date('Y-m-d','now'),
@endif
@endforeach
        ];
    }
}

