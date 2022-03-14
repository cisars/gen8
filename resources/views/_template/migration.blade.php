{{'<?php'}}
{{--CONFIGURACION--}}
@php
    $NOMBRES  = $gen->tabla['ZNOMBRESZ'] ;
    $NOMBRE   = $gen->tabla['ZNOMBREZ'] ;
    $nombres  = $gen->tabla['ZnombresZ'] ;
    $nombre   = $gen->tabla['ZnombreZ'] ;
// GENISA Begin
@endphp
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
@php
    $cantidadPK = 0;  // CantidadPK
        foreach ($gen->tabla['columnas'] as $dataCol){
        if ($dataCol['cardinalidad'] == 'pk' || $dataCol['cardinalidad'] == 'pkfk'){
            $cantidadPK++ ;
        }
    } @endphp

class Create{{$NOMBRES}}Table extends Migration
{
    public function up()
    {
        Schema::create('{{$nombres}}', function (Blueprint $table) {

@if ($cantidadPK > 1 )
@foreach ($gen->tabla['columnas'] as $dataCol)
@php // PK @endphp
@if ($dataCol['cardinalidad'] == 'pk' )
@if ($dataCol['tipo'] == 'int')
            $table->integer('{{$dataCol['nombre']}}') ;
@endif
@if ($dataCol['tipo'] == 'smallint')
            $table->smallInteger('{{$dataCol['nombre']}}');
@endif
@if ($dataCol['tipo'] == 'tinyint')
            $table->tinyInteger('{{$dataCol['nombre']}}');
@endif
@if ($dataCol['tipo'] == 'varchar' || $dataCol['tipo'] == 'char' || $dataCol['tipo'] == 'text' )
            $table->string('{{$dataCol['nombre']}}', {{$dataCol['longitud']}}) ;
@endif
@endif
@php // PKFK @endphp
@if ($dataCol['cardinalidad'] == 'pkfk')
@if ($dataCol['tipo'] == 'int')
            $table->unsignedInteger('{{$dataCol['nombre']}}') ;
@endif
@if ($dataCol['tipo'] == 'smallint')
            $table->unsignedSmallInteger('{{$dataCol['nombre']}}') ;
@endif
@if ($dataCol['tipo'] == 'tinyint')
            $table->unsignedTinyInteger('{{$dataCol['nombre']}}') ;
@endif
@if ($dataCol['tipo'] == 'varchar' || $dataCol['tipo'] == 'char' || $dataCol['tipo'] == 'text' )
            $table->string('{{$dataCol['nombre']}}')->nullable();
@endif
@endif
@endforeach
@endif @php // FIN SI $cantidadPK > 1  @endphp
@if ($cantidadPK == 1 )
@foreach ($gen->tabla['columnas'] as $dataCol)
@php // PK @endphp
@if ($dataCol['cardinalidad'] == 'pk' )
@php
if($dataCol['predeterminado'] == ''){
$predeterminado = 'false';
}else{
$predeterminado = 'true';
}
@endphp
@if ($dataCol['tipo'] == 'int')
            $table->integer('{{$dataCol['nombre']}}',{{$predeterminado}})->unsigned();
@endif
@if ($dataCol['tipo'] == 'smallint')
            $table->smallInteger('{{$dataCol['nombre']}}',{{$predeterminado}})->unsigned();
@endif
@if ($dataCol['tipo'] == 'tinyint')
            $table->tinyInteger('{{$dataCol['nombre']}}',{{$predeterminado}})->unsigned();
@endif
@if ($dataCol['tipo'] == 'varchar' || $dataCol['tipo'] == 'char' || $dataCol['tipo'] == 'text' )
            $table->string('{{$dataCol['nombre']}}', {{$dataCol['longitud']}})->primary();
@endif
@endif
@endforeach
@endif @php // FIN SI $cantidadPK == 1  @endphp

@foreach ($gen->tabla['columnas'] as $dataCol)
@php // FK @endphp
@if ($dataCol['cardinalidad'] == 'fk' || $dataCol['cardinalidad'] == 'pkfk')
@if ($dataCol['tipo'] == 'int')
            $table->unsignedInteger('{{$dataCol['nombre']}}')->nullable();
@endif
@if ($dataCol['tipo'] == 'smallint')
            $table->unsignedSmallInteger('{{$dataCol['nombre']}}')->nullable();
@endif
@if ($dataCol['tipo'] == 'tinyint')
            $table->unsignedTinyInteger('{{$dataCol['nombre']}}')->nullable();
@endif
@if ($dataCol['tipo'] == 'varchar' || $dataCol['tipo'] == 'char' || $dataCol['tipo'] == 'text' )
            $table->string('{{$dataCol['nombre']}}')->nullable();
@endif
@endif
@if ($dataCol['cardinalidad'] == '' || $dataCol['cardinalidad'] == 'cons')
@if ($dataCol['tipo'] == 'int')
            $table->integer('{{$dataCol['nombre']}}')->nullable();
@endif
@if ($dataCol['tipo'] == 'smallint')
            $table->smallInteger('{{$dataCol['nombre']}}')->nullable();
@endif
@if ($dataCol['tipo'] == 'tinyint')
            $table->tinyInteger('{{$dataCol['nombre']}}')->nullable();
@endif
@if ($dataCol['tipo'] == 'numeric')
            $table->float('{{$dataCol['nombre']}}',{{$dataCol['longitud']}})->nullable();
@endif
@if ($dataCol['tipo'] == 'varchar'   )
            $table->string('{{$dataCol['nombre']}}',{{$dataCol['longitud']}})->nullable();
@endif
@if ( $dataCol['tipo'] == 'char' )
            $table->char('{{$dataCol['nombre']}}',{{$dataCol['longitud']}})->nullable();
@endif
@if ( $dataCol['tipo'] == 'text' )
    $table->text('{{$dataCol['nombre']}}',{{$dataCol['longitud']}})->nullable();
@endif
@endif
@endforeach
@if ($cantidadPK > 1 ) @php $coma = ''; @endphp
           $table->primary([@foreach ($gen->tabla['columnas'] as $dataCol)@if($dataCol['cardinalidad'] == 'pk' || $dataCol['cardinalidad'] == 'pkfk'){{$coma}}'{{$dataCol['nombre']}}'@endif@php $coma = ',';@endphp@endforeach]);
@endif

@foreach ($gen->tabla['relaciones'] as $dataRel)
@if($dataRel['eloquent'] == 'belongsTo')
        $table->foreign('{{$dataRel['foreign']}}')
            ->references('{{$dataRel['referencesID']}}')
            ->on('{{$dataRel['onTable']}}')
            ->onDelete('{{$dataRel['onDelete']}}')
            ->onUpdate('{{$dataRel['onUpdate']}}') ;

@endif
@endforeach
            $table->timestamps();
        });

@if ($cantidadPK > 1 )
@foreach ($gen->tabla['columnas'] as $dataCol)
@php
    if($dataCol['predeterminado'] == ''){
    $predeterminado = 'false';
    $predeterminadoTXT = '';
    }else{
    $predeterminado = 'true';
    $predeterminadoTXT = 'AUTO_INCREMENT';
    }
    if($dataCol['nulo'] == 'notnull'){
    $ifnull = 'false';
    $ifnullTXT = 'NOT NULL';
    }else{
    $ifnull = 'true';
    $ifnullTXT = 'NULL';
    }
@endphp
@if ($dataCol['cardinalidad'] == 'pk' || $dataCol['cardinalidad'] == 'pkfk'  )
@if($dataCol['tipo'] == 'tiniyint')
        DB::statement('ALTER TABLE {{$nombres}} MODIFY {{$dataCol['nombre']}} TINYINT {{$ifnullTXT}} {{$predeterminadoTXT}}');
@endif
@if($dataCol['tipo'] == 'smallint')
        DB::statement('ALTER TABLE {{$nombres}} MODIFY {{$dataCol['nombre']}} SMALLINT {{$ifnullTXT}} {{$predeterminadoTXT}}');
@endif
@endif
@endforeach
@if($dataCol['tipo'] == 'int' || $dataCol['tipo'] == 'varchar' || $dataCol['tipo'] == 'char' || $dataCol['tipo'] == 'text' )
        Schema::table('{{$nombres}}', function (Blueprint $table) {
@foreach ($gen->tabla['columnas'] as $dataCol)
@if($dataCol['tipo'] == 'int' || $dataCol['tipo'] == 'varchar' || $dataCol['tipo'] == 'char' || $dataCol['tipo'] == 'text' )
@php
    if($dataCol['predeterminado'] == ''){
    $predeterminado = 'false';
    $predeterminadoTXT = '';
    }else{
    $predeterminado = 'true';
    $predeterminadoTXT = 'AUTO_INCREMENT';
    }
    if($dataCol['nulo'] == 'notnull'){
    $ifnull = 'false';
    $ifnullTXT = 'NOT NULL';
    }else{
    $ifnull = 'true';
    $ifnullTXT = 'NULL';
    }
@endphp
@php // PK o PKFK @endphp
@if ($dataCol['cardinalidad'] == 'pk' || $dataCol['cardinalidad'] == 'pkfk'  )
@if ($dataCol['tipo'] == 'int')
            $table->integer('{{$dataCol['nombre']}}', {{$predeterminado}}, true)->change();
@endif
@if ($dataCol['tipo'] == 'char' || $dataCol['tipo'] == 'char'|| $dataCol['tipo'] == 'text' )
            $table->string('{{$dataCol['nombre']}}', {{$dataCol['longitud']}}) )->change();
@endif
@if ($dataCol['tipo'] == 'varchar' || $dataCol['tipo'] == 'char' || $dataCol['tipo'] == 'text' )
            $table->string('{{$dataCol['nombre']}}', {{$dataCol['longitud']}}) )->change();
@endif
@endif
@endif
@endforeach
        });
@endif
@endif
    }

    public function down()
    {
        Schema::dropIfExists('{{$nombres}}');
    }
}


