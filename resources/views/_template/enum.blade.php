{{'<?php'}}
{{--CONFIGURACION--}}
@php
    $NOMBRES  = $gen->tabla['ZNOMBRESZ'] ;
    $NOMBRE   = $gen->tabla['ZNOMBREZ'] ;
    $nombres  = $gen->tabla['ZnombresZ'] ;
    $nombre   = $gen->tabla['ZnombreZ'] ;
    $dataEnumValues[] = null;
    $arroba = '@';
// GENISA Begin
@endphp
@foreach ($gen->tabla['columnas'] as $dataCol)
@if ($dataCol['tipo'] == 'enum'  )
namespace App\Enum;

use Illuminate\Support\Collection;

enum {{  $dataCol['claseEnum']  }}: string
{

@foreach ($gen->tabla['enumCol'] as $dataEnum)
@if($dataEnum['nombre'] == $dataCol['nombre'] )
    case {{$dataEnum['name']}} = '{{$dataEnum['key']}}';
@endif
@endforeach

    public static function map(): Collection {
        return collect(self::cases())->pluck('name','value') ;
    }
}
------------------------------------------------------------------------------------------------------------
@endif
@endforeach






