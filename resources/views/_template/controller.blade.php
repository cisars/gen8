{{'<?php'}}
{{--CONFIGURACION--}}
@php
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
@endforeach
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class {{$NOMBRE}}Controller extends Controller
{

    public function index()
    {
        ${{$nombres}} = {{$NOMBRE}}::all();

        ${{$nombres}}->each(function (${{$nombre}}) {
@php $aux = ""; @endphp
@foreach ($gen->tabla['constantes'] as $dataCons)
@if($aux != $dataCons['nombres'])
        foreach ((new {{$NOMBRE}}())->get{{ucfirst($dataCons['nombres'])}}() as $clave=>$valor)
        trim(${{$nombre}}->{{$dataCons['nombre']}}) == trim($valor) ? ${{$nombre}}->{{$dataCons['nombre']}} = $clave : NULL ;
@php $aux = $dataCons['nombres']; @endphp
@endif
@endforeach

        //OPCION 2
@foreach ($gen->tabla['constantes'] as $dataCons)
        // ${{$nombre}}->{{$dataCons['nombre']}} === {{$NOMBRE}}::{{$dataCons['clave']}}   ? ${{$nombre}}->{{$dataCons['nombre']}} = '{{$dataCons['clave']}}' : "" ;
@endforeach

        });
        return view('{{$nombres}}.index', compact('{{$nombres}}', ${{$nombres}}));
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
// Construct all cons data base model dropdown list char 1
@foreach ($gen->tabla['constantes'] as $dataCons)
@if($aux != $dataCons['nombres'])
        ${{ $dataCons['nombres'] }} = ${{$nombre}}->get{{ucfirst($dataCons['nombres'])}}() ; // {{$aux = $dataCons['nombres']}}
@endif
@endforeach

        return view('{{$nombres}}.edit')
// Send all fk variables
@foreach ($gen->tabla['columnas'] as $dataCol)
@if ($dataCol['cardinalidad'] == 'fk' || $dataCol['cardinalidad'] == 'cons' || $dataCol['cardinalidad'] == 'pkfk')
            ->with('{{$dataCol['fks']}}', ${{$dataCol['fks']}})
@endif
@endforeach
// Send all cons variables
@foreach ($gen->tabla['constantes'] as $dataCons)
@if($aux != $dataCons['nombres'])
            ->with('{{ $dataCons['nombres'] }}', ${{ $dataCons['nombres'] }})  // {{$aux = $dataCons['nombres']}}
@endif
@endforeach
;
    }

    public function store(Store{{$NOMBRE}}Request $request )
    {
        try {
        DB::beginTransaction();
            ${{$nombre}} = new {{$NOMBRE}}($request->all());
            ${{$nombre}}->save();

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
            Log::error( 'Error en {{$NOMBRE}}Controller@store: '. $e ) ;
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

    public function destroy(Request $request)
    {
        try {
            ${{$nombre}} = {{$NOMBRE}}::findOrFail($request->id);
            ${{$nombre}}->delete();

            Log::info( '{{$NOMBRE}} registro eliminado' ) ;
            return redirect()
                ->route('{{$nombres}}.index')
                ->with('msg', 'Registro Eliminado Correctamente')
                ->with('type', 'danger');
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error( 'Error en {{$NOMBRE}}Controller@destroy: '. $e ) ;
            return redirect()
                ->route('{{$nombres}}.index')
                ->with('msg', 'Ocurrio un error')
                ->with('type', 'danger');
        }
    }

    public function edit({{$NOMBRE}} ${{$nombre}})
    {
// Get all data fk tables
@foreach ($gen->tabla['columnas'] as $dataCol)
@if ($dataCol['cardinalidad'] == 'fk' || $dataCol['cardinalidad'] == 'pkfk')
        ${{$dataCol['fks']}} = {{$dataCol['FK']}}::orderBy('{{$dataCol['orderby']}}', 'ASC')->get();
@endif
@endforeach

// Set all function cons base model dropdown list char 1 {{$aux = NULL}}
@foreach ($gen->tabla['constantes'] as $dataCons)
@if($aux != $dataCons['nombres'])
        ${{ $dataCons['nombres'] }} = ${{$nombre}}->get{{ucfirst($dataCons['nombres'])}}() ; // {{$aux = $dataCons['nombres']}}
@endif
@endforeach

        return view('{{$nombres}}.edit')
            ->with('{{$nombre}}', ${{$nombre}})
// Send all fk variables
@foreach ($gen->tabla['columnas'] as $dataCol)
@if ($dataCol['cardinalidad'] == 'fk' || $dataCol['cardinalidad'] == 'pkfk')
            ->with('{{$dataCol['fks']}}', ${{$dataCol['fks']}})
@endif
@endforeach

// Send all cons variables {{$aux = NULL}}
@foreach ($gen->tabla['constantes'] as $dataCons)
@if($aux != $dataCons['nombres'])
            ->with('{{ $dataCons['nombres'] }}', ${{ $dataCons['nombres'] }})  // {{$aux = $dataCons['nombres']}}
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
        factory('App\Models\{{$NOMBRE}}')->create();
        Log::warning( 'Factory creado en {{$NOMBRE}} ') ;
        return redirect()
            ->route('{{$nombres}}.index')
            ->with('msg', 'Registro Creado Correctamente')
            ->with('type', 'success');
    }
}

{{'?>'}}

