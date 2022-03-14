{{'<?php'}}
{{--CONFIGURACION--}}
@php
    $NOMBRES  = $gen->tabla['ZNOMBRESZ'] ;
    $NOMBRE   = $gen->tabla['ZNOMBREZ'] ;
    $nombres  = $gen->tabla['ZnombresZ'] ;
    $nombre   = $gen->tabla['ZnombreZ'] ;
// GENISA Begin
@endphp
namespace App\Http\Requests\{{$NOMBRE}};
use Illuminate\Foundation\Http\FormRequest;

class Store{{$NOMBRE}}Request extends FormRequest
{
    /**
    * Determine if the user is authorized to make this request.
    * @return bool
    */
    public function authorize()
    {
        return true;
    }

    /**
    * Get the validation rules that apply to the request.
    * @return array
    */
    public function rules()
    {
    return [
@foreach ($gen->tabla['columnas'] as $dataCol)
@if (  $dataCol['cardinalidad'] == '') // {{$slash = ''}} {{$propiedades = ''}} @if ($dataCol['nulo'] == 'notnull' ) {{$propiedades = 'required' . $slash . $propiedades}} {{$slash = '|'}} alfa @endif @if ($dataCol['longitud'] != '' ) {{$propiedades = 'max:'.$dataCol['longitud'] . $slash . $propiedades}}  {{$slash = '|'}} beta @endif

           '{{$dataCol['nombre']}}' =>'{{$propiedades}}', @endif
@if (  $dataCol['cardinalidad'] == 'pk' || $dataCol['cardinalidad'] == 'pkfk')
//           '{{$dataCol['nombre']}}' =>'required', @endif
@if (  $dataCol['cardinalidad'] == 'fk')

           '{{$dataCol['nombre']}}' =>'required', @endif
@if (  $dataCol['cardinalidad'] == 'unique') // {{$slash = ''}} {{$propiedades = ''}} @if ($dataCol['nulo'] == 'notnull' ) // {{$propiedades = 'required' . $slash . $propiedades}} // {{$slash = '|'}} @endif @if ($dataCol['longitud'] != '' )// {{$propiedades = 'max:'.$dataCol['longitud'] . $slash . $propiedades}} // {{$slash = '|'}} @endif //{{$propiedades = $propiedades . $slash . 'unique:'.$nombres.','.$dataCol['nombre']}}
           '{{$dataCol['nombre']}}' =>'{{$propiedades}}',
@endif @if (  $dataCol['cardinalidad'] == 'cons') // {{$slash = ''}} {{$propiedades = ''}} @if ($dataCol['nulo'] == 'notnull' ) // {{$propiedades = 'required' . $slash . $propiedades}} // {{$slash = '|'}} @endif @if ($dataCol['longitud'] != '' ) // {{$propiedades = 'max:'.$dataCol['longitud'] . $slash . $propiedades}} // {{$slash = '|'}} @endif

           '{{$dataCol['nombre']}}' =>'{{$propiedades}}', @endif @endforeach


        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    * @return array
    */
    public function messages()
    {
    return [
@foreach ($gen->tabla['columnas'] as $dataCol)
@if (  $dataCol['nulo'] == 'notnull' && $dataCol['visibilidad'] != 'hidden'  )
        '{{$dataCol['nombre']}}.required' => 'Debe introducir {{$dataCol['visibilidad']}}',
@endif
@if (  $dataCol['longitud'] != '' && $dataCol['visibilidad'] != 'hidden'  )
        '{{$dataCol['nombre']}}.max' => '{{$dataCol['visibilidad']}} no puede exceder {{$dataCol['longitud']}} de longitud',
@endif
@if (  $dataCol['cardinalidad'] == 'unique' && $dataCol['visibilidad'] != 'hidden'  )
        '{{$dataCol['nombre']}}.unique' => 'El registro para {{$dataCol['visibilidad']}} ya existe',
@endif
@endforeach
        ];
    }
}
