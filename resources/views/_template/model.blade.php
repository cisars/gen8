{{'<?php'}}
{{--CONFIGURACION--}}
@php
    $NOMBRES  = $gen->tabla['ZNOMBRESZ'] ;
    $NOMBRE   = $gen->tabla['ZNOMBREZ'] ;
    $nombres  = $gen->tabla['ZnombresZ'] ;
    $nombre   = $gen->tabla['ZnombreZ'] ;
// GENISA Begin
@endphp
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class {{$NOMBRE}} extends Model
{

    use HasFactory;

    protected $table = '{{$nombres}}';
    //protected $primaryKey = 'empleado';
    //protected $fillable = [];
    protected $guarded = [];

// Create all cons var with data {{$aux = null}}
@foreach ($gen->tabla['constantes'] as $dataCons)
@if($aux != $dataCons['nombres'])
    // {{ ucfirst($dataCons['nombre']) }}
@endif
    const {{ $dataCons['clave'] }} = '{{ $dataCons['valor'] }}'; // {{$aux = $dataCons['nombres']}}
@endforeach

// Create all cons FUNCTIONS {{$aux = null}}
@foreach ($gen->tabla['constantes'] as $dataCons)
@if($aux != $dataCons['nombres'])
    // Funcion {{ ucfirst($dataCons['nombre']) }} // {{ $aux = $dataCons['nombres'] }}
    public function get{{ ucfirst($dataCons['nombres']) }}()
    {
        return ${{$dataCons['nombres']}} = [
@foreach ($gen->tabla['constantes'] as $dataCons)
@if($aux == $dataCons['nombres'])
        '{{$dataCons['descripcion']}}' => {{$NOMBRE}}::{{$dataCons['clave']}},
@endif
@endforeach
        ];
    }
@endif
@endforeach

@foreach ($gen->tabla['columnas'] as $dataCol)
@if ($dataCol['cardinalidad'] == 'fk' || $dataCol['cardinalidad'] == 'pkfk')
    public function {{$dataCol['fk']}}()
    {
        return $this->belongsTo({{$dataCol['FK']}}::class, '{{$dataCol['fk']}}_id');
    }
@endif
@endforeach

@foreach ($gen->tabla['relaciones'] as $dataRel)
@if('hasMany' == $dataRel['eloquent'])
    public function {{$dataRel['funcion']}}()
    {
        return $this->hasMany({{$dataRel['related']}}, '{{$nombre}}_id');
    }
@endif
@if('belongsToMany' == $dataRel['eloquent'])
    public function {{$dataRel['funcion']}}()
    {
    return $this->belongsToMany({{$dataRel['relation']}}::class, '{{$dataRel['onTable']}}',
    '{{$dataRel['foreignkey']}}', '{{$dataRel['localownerkey']}}');
    }
@endif
@endforeach

}

{{'?>'}}
