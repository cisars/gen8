{{'<?php'}}
{{--CONFIGURACION--}}
@php

     $_head   =  $gen->tabla['ZcontrollerHeadZ'] ;
     $_detail =  $gen->tabla['ZcontrollerDetailZ'] ;


     $NOMBRES  = $gen->tabla['ZNOMBRESZ'] ;
     $NOMBRE   = $gen->tabla['ZNOMBREZ'] ;
     $nombres  = $gen->tabla['ZnombresZ'] ;
     $nombre   = $gen->tabla['ZnombreZ'] ;
 // GENISA Begin
@endphp
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Http\Requests\{{$NOMBRE}}\Store{{$NOMBRE}}Request;
use App\Http\Requests\{{$NOMBRE}}\Update{{$NOMBRE}}Request;
use App\Models\{{$NOMBRE}};
@foreach ($gen->tabla['columnas'] as $dataCol)
@if ($dataCol['cardinalidad'] == 'fk' || $dataCol['cardinalidad'] == 'pkfk'  )
use App\Models\{{$dataCol['FK']}};
@endif
@if ($dataCol['tipo'] == 'enum'  )
use App\Enum\{{$dataCol['claseEnum']}};
@endif
@endforeach
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class {{$NOMBRE}}Controller extends Controller
{

    public function index()
    {
        ${{$nombres}} = {{$NOMBRE}}::all();
@foreach ($gen->tabla['columnas'] as $dataCol)
@if( $dataCol['tipo'] == 'enum')
    // Create all ENUM variables {{$aux = null}}
@foreach ($gen->tabla['enumCol'] as $dataEnum)
@if($aux != $dataEnum['nombre'])
@if($dataEnum['nombre'] == $dataCol['nombre'])
       // ${{$dataEnum['nombre']}} = {{$dataCol['claseEnum']}}::map(); // {{$aux = $dataEnum['nombre']}}
@endif
@endif
@endforeach
@endif
@if( $dataCol['tipo'] == 'cons')
    // Create all CONS variables {{$aux = null}}
        ${{$nombres}}->each(function (${{$nombre}}) {
@foreach ($gen->tabla['constantes'] as $dataCons)
@if($aux != $dataCons['nombres'])
        foreach ((new {{$NOMBRE}}())->get{{ucfirst($dataCons['nombres'])}}() as $clave=>$valor)
            trim(${{$nombre}}->{{$dataCons['nombre']}}) == trim($valor) ? ${{$nombre}}->{{$dataCons['nombre']}} = $clave : NULL ; // {{$aux = $dataCons['nombres']}}
@endif
@endforeach
        });
        //OPCION 2
@foreach ($gen->tabla['constantes'] as $dataCons)
        // ${{$nombre}}->{{$dataCons['nombre']}} === {{$NOMBRE}}::{{$dataCons['clave']}}   ? ${{$nombre}}->{{$dataCons['nombre']}} = '{{$dataCons['clave']}}' : "" ;
@endforeach
@endif
@endforeach

        return view('{{$nombres}}.index', compact('{{$nombres}}'));
    }

    public function create()
    {
// Get all data fk tables
@foreach ($gen->tabla['columnas'] as $dataCol)
@if ($dataCol['cardinalidad'] == 'fk' || $dataCol['cardinalidad'] == 'pkfk')
        ${{$dataCol['fks']}} = {{$dataCol['FK']}}::orderBy('{{$dataCol['orderby']}}', 'ASC')->get();
@endif
@endforeach

        ${{$nombre}}   = new {{$NOMBRE}}(); // {{$aux = null}}

@foreach ($gen->tabla['columnas'] as $dataCol)
@if( $dataCol['tipo'] == 'enum')
    // Create all ENUM map {{$aux = null}}
@foreach ($gen->tabla['enumCol'] as $dataEnum)
@if($aux != $dataEnum['nombre'])
@if($dataEnum['nombre'] == $dataCol['nombre'])
        ${{$dataCol['nombresEnum']}} = {{$dataCol['claseEnum']}}::map(); // {{$aux = $dataEnum['nombre']}}
@endif
@endif
@endforeach
@endif
@if( $dataCol['tipo'] == 'cons')
        // Create all CONS {{$aux = null}}
        ${{$nombres}}->each(function (${{$nombre}}) {
@foreach ($gen->tabla['constantes'] as $dataCons)
@if($aux != $dataCons['nombres'])
        // Construct all cons data base model dropdown list char 1
        ${{ $dataCons['nombres'] }} = ${{$nombre}}->get{{ucfirst($dataCons['nombres'])}}() ; // {{$aux = $dataCons['nombres']}}
@endif
@endforeach
@endif
@endforeach
        return view('{{$nombres}}.edit')
        // Send all fk variables
@foreach ($gen->tabla['columnas'] as $dataCol)
@if ($dataCol['cardinalidad'] == 'fk' || $dataCol['cardinalidad'] == 'cons' || $dataCol['cardinalidad'] == 'pkfk')
            ->with('{{$dataCol['fks']}}', ${{$dataCol['fks']}})
@endif
@endforeach
@foreach ($gen->tabla['columnas'] as $dataCol)
@if( $dataCol['tipo'] == 'cons')
        // Send all cons variables {{$aux = null}}
@foreach ($gen->tabla['constantes'] as $dataCons)
@if($aux != $dataCons['nombres'])
            ->with('{{ $dataCons['nombres'] }}', ${{ $dataCons['nombres'] }})  // {{$aux = $dataCons['nombres']}}
@endif
@endforeach
@endif
@endforeach

@foreach ($gen->tabla['columnas'] as $dataCol)
@if( $dataCol['tipo'] == 'enum')
        // Send all enum variables {{$aux = null}}
@foreach ($gen->tabla['enumCol'] as $dataEnum)
@if($aux != $dataEnum['nombre'])
@if($dataEnum['nombre'] == $dataCol['nombre'])
            ->with('{{ $dataCol['nombresEnum'] }}', ${{ $dataCol['nombresEnum'] }})  // {{$aux = $dataEnum['nombre']}}
@endif
@endif
@endforeach
@endif
@if( $dataCol['tipo'] == 'cons')
        // Send all cons variables {{$aux = null}}
        // Construct all cons data base model dropdown list char 1
@foreach ($gen->tabla['constantes'] as $dataCons)
@if($aux != $dataCons['nombres'])
            ->with('{{$dataCol['fks']}}', ${{$dataCol['fks']}}) // {{$aux = $dataCons['nombres']}}
@endif
@endforeach
@endif
@endforeach
;
    }

    public function store(Store{{$NOMBRE}}Request $request )
    {
        try {
        DB::beginTransaction();
            {{$NOMBRE}}::create($request->all());
        //    ${{$nombre}} = new {{$NOMBRE}}($request->all());
        //    ${{$nombre}}->save();

@foreach ($gen->tabla['relaciones'] as $dataRel)
@if ($dataRel['eloquent'] == 'belongsToMany' || $dataRel['eloquent'] == 'manyToMany'  )
           foreach ($request->{{ $dataRel['foreign'] }} as $item) {
//               ${{ $dataRel['onTable'] }} = new {{ $dataRel['related'] }}();
//               ${{ $dataRel['onTable'] }}->{{ $dataRel['foreign'] }} = $item;
//               ${{ $dataRel['onTable'] }}->{{$nombre}}_id  = ${{$nombre}}->id;
//               ${{ $dataRel['onTable'] }}->save();
//                Log::info( 'Detalle #{{$dataRel['foreign']}} agregado en {{$dataRel['related']}}' ) ;
           }
@endif
@endforeach
            DB::commit();

        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            dd($e->getMessage());
            Log::error( 'Error en {{$NOMBRE}}Controller@store: '. $e->getMessage() ) ;
            return redirect()
                ->route('{{$nombres}}.index')
                ->with('msg', 'Ocurrio un error')
                ->with('type', 'danger');
        }
        Log::info( '{{$NOMBRE}} registro creado' ) ;
        return redirect()
            ->route('{{$nombres}}.index')
            ->with('msg', 'Registro Creado Correctamente')
            ->with('type', 'info');

    }

    public function destroy({{$NOMBRE}} ${{$nombre}})
    {
        try {
            ${{$nombre}}->delete();
        //    ${{$nombre}} = {{$NOMBRE}}::findOrFail($request->id);
        //    ${{$nombre}}->delete();

            Log::info( '{{$NOMBRE}} registro eliminado' ) ;
            return redirect()
                ->route('{{$nombres}}.index')
                ->with('msg', 'Registro Eliminado Correctamente')
                ->with('type', 'danger');
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
            Log::error( 'Error en {{$NOMBRE}}Controller@destroy: '. $e->getMessage() ) ;
            return redirect()
                ->route('{{$nombres}}.index')
                ->with('msg', 'Ocurrio un error')
                ->with('type', 'danger');
        }
    }

    public function edit({{$NOMBRE}} ${{$nombre}})
    {
// Get all data fk tables
@php $aux1 = 'enum' @endphp
@php $aux2 = 'cons' @endphp
@foreach ($gen->tabla['columnas'] as $dataCol)
@if ($dataCol['cardinalidad'] == 'fk' || $dataCol['cardinalidad'] == 'pkfk')
        ${{$dataCol['fks']}} = {{$dataCol['FK']}}::orderBy('{{$dataCol['orderby']}}', 'ASC')->get();
@endif
@endforeach
@php $aux = null @endphp
@foreach ($gen->tabla['columnas'] as $dataCol)
@if( $dataCol['tipo'] == 'enum')
@if($aux1 == 'enum')
        // Create all ENUM map // {{$aux1 = NULL }}
@endif
@foreach ($gen->tabla['enumCol'] as $dataEnum)
@if($aux != $dataEnum['nombre'])
@if($dataEnum['nombre'] == $dataCol['nombre'])
        ${{$dataCol['nombresEnum']}} = {{$dataCol['claseEnum']}}::map(); // {{$aux = $dataEnum['nombre']}}
@endif
@endif
@endforeach
@endif
@php $aux = null @endphp
@if( $dataCol['tipo'] == 'cons')
@if($aux2 == 'cons')
        // Create all CONS // {{$aux2 = NULL }}
        // Construct all cons data base model dropdown list char 1
@endif
@foreach ($gen->tabla['constantes'] as $dataCons)
@if($aux != $dataCons['nombres'])
        ${{ $dataCons['nombres'] }} = ${{$nombre}}->get{{ucfirst($dataCons['nombres'])}}() ; // {{$aux = $dataCons['nombres']}}
@endif
@endforeach
@endif
@endforeach

        return view('{{$nombres}}.edit')
            ->with('{{$nombre}}', ${{$nombre}})
        // Send all fk variables
@php $aux1 = 'enum' @endphp
@php $aux2 = 'cons' @endphp
@foreach ($gen->tabla['columnas'] as $dataCol)
@if ($dataCol['cardinalidad'] == 'fk' || $dataCol['cardinalidad'] == 'pkfk')
            ->with('{{$dataCol['fks']}}', ${{$dataCol['fks']}})
@endif
@if( $dataCol['tipo'] == 'enum')
@if($aux1 == 'enum' )
        // Send all ENUM variables  // {{$aux1 = NULL }}
@endif
@foreach ($gen->tabla['enumCol'] as $dataEnum)
@if($aux != $dataEnum['nombre'])
@if($dataEnum['nombre'] == $dataCol['nombre'])
                ->with('{{$dataCol['nombresEnum']}}', ${{$dataCol['nombresEnum']}})  // {{$aux = $dataEnum['nombre']}}
@endif
@endif
@endforeach
@endif
@php $aux = null @endphp
@if( $dataCol['tipo'] == 'cons')
@if($aux2 == 'cons' )
        // Send all CONS variables // {{$aux1 = NULL }}
@endif
@foreach ($gen->tabla['constantes'] as $dataCons)
@if($aux != $dataCons['nombres'])
            ->with('{{ $dataCons['nombres'] }}', ${{ $dataCons['nombres'] }})  // {{$aux = $dataCons['nombres']}}
@endif
@endforeach
@endif
@endforeach
;
    }

    public function update(Update{{$NOMBRE}}Request $request, {{$NOMBRE}} ${{$nombre}})
    {
        try {
            DB::beginTransaction();
            ${{$nombre}}->fill($request->all());
            ${{$nombre}}->save();
            DB::commit();
            Log::info( '{{$NOMBRE}} registro actualizado ') ;
            return redirect()
                ->route('{{$nombres}}.index')
                ->with('msg', 'Registro Actualizado Correctamente')
                ->with('type', 'info');
        }catch (\Exception $e){
            DB::rollBack();
            Log::error( 'Error en {{$NOMBRE}}Controller@update: '. $e ) ;
            return redirect()
                ->route('{{$nombres}}.index')
                ->with('type', 'danger')
                ->with('msg', 'Ocurrio un error');
        }

    }
    public function factory()
    {
        $this->factory('App\Models\{{$NOMBRE}}')->create();
        Log::warning( 'Factory creado en {{$NOMBRE}} ') ;
        return redirect()
            ->route('{{$nombres}}.index')
            ->with('msg', 'Registro Creado Correctamente')
            ->with('type', 'success');
    }
}

{{'?>'}}

