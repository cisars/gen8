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

use MyCLabs\Enum\Enum;
/**
 * The Status enum.
 *
@foreach ($gen->tabla['enumCol'] as $dataEnum)
@if($dataEnum['nombre'] == $dataCol['nombre'] )
 * {{$arroba}}method static self {{$dataEnum['clave']}}()
@endif
@endforeach
 */
class {{  $dataCol['claseEnum']  }} extends Enum
{
    // Create all cons var with data
    // {{$NOMBRES}}
@foreach ($gen->tabla['enumCol'] as $dataEnum)
@if($dataEnum['nombre'] == $dataCol['nombre'] )
    const {{$dataEnum['clave']}} = '{{$dataEnum['valor']}}';
@endif
@endforeach
    /**
    * Retrieve a map of enum keys and values.
    *
    * @return array
    */
    public static function map() : array
    {
        return [
@foreach ($gen->tabla['enumCol'] as $dataEnum)
@if($dataEnum['nombre'] == $dataCol['nombre'] )
            static::{{$dataEnum['clave']}} => '{{$dataEnum['descripcion']}}',
@endif
@endforeach
        ];
    }
}
------------------------------------------------------------------------------------------------------------
@endif
@endforeach






