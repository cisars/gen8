<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use stdClass;

class MakeTemplateController extends Controller
{
    public function inicializar(Request $request)
    {
        system('php artisan make:model Models/' . $request->capital . ' -fmc ', $rt);
        system('php artisan make:view ' . $request->minuscula . '.index', $rt);
        system('php artisan make:view ' . $request->minuscula . '.edit', $rt);
        system('php artisan make:request ' . $request->capital . '/Store' . $request->capital . 'Request', $rt);
        system('php artisan make:request ' . $request->capital . '/Update' . $request->capital . 'Request', $rt);
    }

    public function toFile(Request $request)
    {

        Storage::disk('gensystem')->put($request->capital . 'Controller.php', $request->codigocontroller);
        Storage::disk('gensystem')->put($request->capital . '.php', $request->codigomodel);
        Storage::disk('gensystem')->put('views/' . $request->capital . '/index.blade.php', $request->codigoindex);
        Storage::disk('gensystem')->put('views/' . $request->capital . '/edit.blade.php', $request->codigoedit);
        Storage::disk('gensystem')->put('factories/' . $request->capital . 'Factory.php', $request->codigofake);
        Storage::disk('gensystem')->put('Requests/' . $request->capital . '/Store' . $request->capital . 'Request.php', $request->codigorequeststore);
        Storage::disk('gensystem')->put('Requests/' . $request->capital . '/Update' . $request->capital . 'Request.php', $request->codigorequestupdate);

        $opciones = ' /y /z /r ';
//        shell_exec('xcopy ' . env('ABSOLUTE_PATH') . trim('\public\GenisaFiles\ ') . $request->capital . 'Controller.php ' . env('ABSOLUTE_PATH') . '\app\Http\Controllers '. $opciones );
//        shell_exec('xcopy ' . env('ABSOLUTE_PATH') . trim('\public\GenisaFiles\ ') . $request->capital . '.php ' . env('ABSOLUTE_PATH') . '\app\Models '. $opciones );
//        shell_exec('xcopy ' . env('ABSOLUTE_PATH') . trim('\public\GenisaFiles\views\ ') . $request->capital . '\index.blade.php ' . env('ABSOLUTE_PATH') . trim('\resources\views\ ') . $request->minuscula . '\ '. $opciones );
//        shell_exec('xcopy ' . env('ABSOLUTE_PATH') . trim('\public\GenisaFiles\views\ ') . $request->capital . '\edit.blade.php ' . env('ABSOLUTE_PATH') . trim('\resources\views\ ') . $request->minuscula . '\ '. $opciones );
//        shell_exec('xcopy ' . env('ABSOLUTE_PATH') . trim('\public\GenisaFiles\factories\ ') . $request->capital . 'Factory.php ' . env('ABSOLUTE_PATH') . '\database\factories '. $opciones );
//        shell_exec('xcopy ' . env('ABSOLUTE_PATH') . trim('\public\GenisaFiles\Requests\ ') . $request->capital . '\Store' . $request->capital . 'Request.php ' . env('ABSOLUTE_PATH') . trim('\app\Http\Requests\ ') . $request->capital . ' '. $opciones );
//        shell_exec('xcopy ' . env('ABSOLUTE_PATH') . trim('\public\GenisaFiles\Requests\ ') . $request->capital . '\Update' . $request->capital . 'Request.php ' . env('ABSOLUTE_PATH') . trim('\app\Http\Requests\ ') . $request->capital . ' '. $opciones );


        Log::info( '#Controller: xcopy ' . env('ABSOLUTE_PATH') . trim('\public\GenisaFiles\ ') . $request->capital . 'Controller.php ' . env('ABSOLUTE_PATH') . '\app\Http\Controllers '. $opciones ) ;
        system('xcopy ' . env('ABSOLUTE_PATH') . trim('\public\GenisaFiles\ ') . $request->capital . 'Controller.php ' . env('ABSOLUTE_PATH') . '\app\Http\Controllers '. $opciones, $rscontroller);
        Log::info( '1/7 #Controller: '. $rscontroller) ;

        Log::info( '#Model: xcopy ' . env('ABSOLUTE_PATH') . trim('\public\GenisaFiles\ ') . $request->capital . '.php ' . env('ABSOLUTE_PATH') . '\app\Models\ '. $opciones) ;
        system('xcopy ' . env('ABSOLUTE_PATH') . trim('\public\GenisaFiles\ ') . $request->capital . '.php ' . env('ABSOLUTE_PATH') . '\app\Models\ '. $opciones, $rsmodel);
        Log::info( '2/7 #Model: '. $rsmodel) ;

        Log::info( '#Index: xcopy ' . env('ABSOLUTE_PATH') . trim('\public\GenisaFiles\views\ ') . $request->capital . '\index.blade.php ' . env('ABSOLUTE_PATH') . trim('\resources\views\ ') . $request->minuscula . '\ '. $opciones) ;
        system('xcopy ' . env('ABSOLUTE_PATH') . trim('\public\GenisaFiles\views\ ') . $request->capital . '\index.blade.php ' . env('ABSOLUTE_PATH') . trim('\resources\views\ ') . $request->minuscula . '\ '. $opciones, $rsindex);
        Log::info( '3/7 #Index: '. $rsindex) ;

        Log::info( '#Edit: xcopy ' . env('ABSOLUTE_PATH') . trim('\public\GenisaFiles\views\ ') . $request->capital . '\edit.blade.php ' . env('ABSOLUTE_PATH') . trim('\resources\views\ ') . $request->minuscula . '\ '. $opciones) ;
        system('xcopy ' . env('ABSOLUTE_PATH') . trim('\public\GenisaFiles\views\ ') . $request->capital . '\edit.blade.php ' . env('ABSOLUTE_PATH') . trim('\resources\views\ ') . $request->minuscula . '\ '. $opciones, $rsedit);
        Log::info( '4/7 #Edit: '. $rsedit) ;

        Log::info( '#Factory: xcopy ' . env('ABSOLUTE_PATH') . trim('\public\GenisaFiles\factories\ ') . $request->capital . 'Factory.php ' . env('ABSOLUTE_PATH') . '\database\factories\ '. $opciones) ;
        system('xcopy ' . env('ABSOLUTE_PATH') . trim('\public\GenisaFiles\factories\ ') . $request->capital . 'Factory.php ' . env('ABSOLUTE_PATH') . '\database\factories\ '. $opciones, $rsfactory);
        Log::info( '5/7 #Factory: '. $rsfactory) ;

        Log::info( '#Store: xcopy ' . env('ABSOLUTE_PATH') . trim('\public\GenisaFiles\Requests\ ') . $request->capital . '\Store' . $request->capital . 'Request.php ' . env('ABSOLUTE_PATH') . trim('\app\Http\Requests\ ') . $request->capital . '\ '. $opciones) ;
        system('xcopy ' . env('ABSOLUTE_PATH') . trim('\public\GenisaFiles\Requests\ ') . $request->capital . '\Store' . $request->capital . 'Request.php ' . env('ABSOLUTE_PATH') . trim('\app\Http\Requests\ ') . $request->capital . '\ '. $opciones, $rsstore);
        Log::info( '6/7 #Store: '. $rsstore) ;

        Log::info( '#Update: xcopy ' . env('ABSOLUTE_PATH') . trim('\public\GenisaFiles\Requests\ ') . $request->capital . '\Update' . $request->capital . 'Request.php ' . env('ABSOLUTE_PATH') . trim('\app\Http\Requests\ ') . $request->capital . '\ '. $opciones) ;
        system('xcopy ' . env('ABSOLUTE_PATH') . trim('\public\GenisaFiles\Requests\ ') . $request->capital . '\Update' . $request->capital . 'Request.php ' . env('ABSOLUTE_PATH') . trim('\app\Http\Requests\ ') . $request->capital . '\ '. $opciones, $rsupdate);
        Log::info( '7/7 #Update: '. $rsupdate) ;

        $rs = [
            'controller' => $rscontroller,
            'model' => $rsmodel,
            'index' => $rsindex,
            'edit' => $rsedit,
            'factory' => $rsfactory,
            'store' => $rsstore,
            'update' => $rsupdate
        ];
        // dd( $rs);
        // 'file.txt' // yo can use your file name here.
        // 'Your content here' // you can specify your content here
        return redirect()
            ->route($request->minuscula . 'gen')
            ->with('msg', 'Archivo generado')
            ->with('type', 'warning');
    }

    public function setValores(
        string $nombre,
        string $dbtipo,
        string $longitud = NULL,
        string $atributo = NULL,
        string $predeterminado = NULL,
        string $extra = NULL,
        string $unico = NULL,
        string $nombreclave = NULL
    )
    {
//        $this->setValores('empleado','integer','2','primario','','AUTO_INCREMENT')
//
//        $todo =
//            [
//                'dbtipo'        => 'integer',
//                'longitud'      => '10',
//                'nombre'        => 'empleado',
//                'atributo'      => 'unsigned',
//                'predeterminado'=> 'null',
//                'extra'         => 'AUTO_INCREMENT',
//                'unico'         => 'si',
//                'nombreclave'   => 'PRIMARY',
//            ];
    }
//$table->foreign('cargo_id')
//->references('id')
//->on('cargos')
//->onDelete('CASCADE')
//->onUpdate('CASCADE')
    public function foreign(
        $foreign = null,
        $referencesID = null,
        $onTable = null,
        $onDelete = null,
        $onUpdate = null,

        $funcion = null,
        $eloquent = null,
        $related = null,
        $foreignkey = null,
        $localownerkey = null,
        $relation = null

    )
    {
        return [
            'foreign' => $foreign,
            'referencesID' => $referencesID,
            'onTable' => $onTable,
            'onDelete' => $onDelete,
            'onUpdate' => $onUpdate,

            'funcion' => $funcion,
            'eloquent' => $eloquent,
            'related' => $related,
            'foreignkey' => $foreignkey,
            'localownerkey' => $localownerkey,
            'relation' => $relation

        ];
    }

    public function enumCol(
        $nombre = null,
        $key = null,
        $name = null
    )
    {
        return [
            'nombre' => $nombre,
            'key' => $key,
            'name' => $name
        ];
    }

    public function constantes(
        $nombre = null,
        $clave = null,
        $valor = null,
        $nombres = null,
        $descripcion = null,
        $visibilidad = null
    )
    {
        return [
            'nombre' => $nombre,
            'clave' => $clave,
            'valor' => $valor,
            'nombres' => $nombres,
            'descripcion' => $descripcion,
            'visibilidad' => $visibilidad
        ];
    }

    public function parametros(
        $nombre = null,
        $visibilidad = null,
        $tipo = null,
        $longitud = null,
        $nulo = null,
        $cardinalidad = null,
        $predeterminado = null,
        $FK = null,
        $fks = null,
        $fk = null,
        $orderby = null,
        $selectdesc = 'descripcion',
        $nombresEnum = 'nombresEnum',
        $claseEnum = 'claseEnum'

    )
    {
        /*
        $table->foreign('localidad_id')
            ->references('id')
            ->on('localidades');
        ->onDelete('CASCADE')
        ->onUpdate('CASCADE')
        */
        return [
            'nombre' => $nombre,
            'visibilidad' => $visibilidad,
            'tipo' => $tipo,
            'longitud' => $longitud,
            'nulo' => $nulo,
            'cardinalidad' => $cardinalidad,
            'predeterminado' => $predeterminado,
            'FK' => $FK,
            'fks' => $fks,
            'fk' => $fk,
            'orderby' => $orderby,
            'selectdesc' => $selectdesc,
            'nombresEnum' => $nombresEnum,
            'claseEnum' => $claseEnum

        ];
    }

    public function index()
    {
//                                                                    // talleres usuarios
//                                                            //        $usuarios = Usuario::all();
//                                                            //        $usuarios = Usuario::with(['usuario' => 'isaias']);
//                                                            //        $isaias = Usuario::find('isaias');
//                                                            //
//                                                            //
//                                                            //        dd($usuarios);
//                                                            //        dd($isaias->talleres());
//
//                                                                    $isaias = Usuario::find('isaias');
//                                                                    dd($isaias->talleres);
//
//
//
//                                                                    //recepciones sintomas
//                                                                    $recepcion = Recepcion::find(2);
//                                                                    dd($recepcion->sintomas);

        $gen = new stdClass();
        $tabla = [
            'nombre' => 'feriados',
            'pk1' =>
                [
                    'nombre' => 'feriado',
                    'tipo' => 'integer',
                    'longitud' => '',
                    'autoincrement' => 'si',
                ],
            'fk1' =>
                [
                    'nombre' => 'calendario',
                    'tipo' => 'integer',
                    'longitud' => '',
                    'autoincrement' => 'si',
                ],
        ];
        // ################################################VARs#################################################
        /*
        ZZNOMBREZZ
ZZnombresZZ
ZZnombreZZ

ZZFK1ZZ     -       ZZfks1ZZ        -       ZZfk1ZZ
ZZFK2ZZ     -       ZZfks2ZZ        -       ZZfk2ZZ
ZZFK3ZZ     -       ZZfks3ZZ        -       ZZfk3ZZ
ZZFK4ZZ     -       ZZfks4ZZ        -       ZZfk4ZZ
ZZFK5ZZ     -       ZZfks5ZZ        -       ZZfk5ZZ
ZZFK6ZZ     -       ZZfks6ZZ        -       ZZfk6ZZ

ZZESTADO1ZZ     -   ZZestado1ZZ    -    ZZestados1ZZ    -   <<getEstados1>>    -    <<estados1>>
    ZZESTADO2ZZ     -   ZZestado2ZZ    -    ZZestados2ZZ    -   <<getEstados2>>    -    <<estados2>>
    ZZESTADO3ZZ     -   ZZestado3ZZ    -    ZZestados3ZZ    -   <<getEstados3>>    -    <<estados3>>
*/
        // ################################################VARs#################################################
        $tabla =
            [
                'ZNOMBRESZ' => 'Tests',
                'ZNOMBREZ' => 'Test',
                'ZnombresZ' => 'tests',
                'ZnombreZ' => 'test',
                'columnas' =>
                    [
                        $this->parametros('id', 'hidden', 'smallint', '', 'notnull', 'pk', 'autoincrement', '', '', '', ''),
                        $this->parametros('test_id', 'Test', 'smallint', '0', 'notnull', 'fk', '',
                            'Test', 'tests', 'test', 'razon_social', ''),

                    ],
                'relaciones' =>
                    [
                        $this->foreign('test_id', 'id', 'tests', 'CASCADE', 'CASCADE',
                            'test', 'belongsTo', 'Test::class', 'test_id', '', ''),
                    ],
                'constantes' =>
                    [

                        $this->constantes('estado_civil', 'TEST_CASADO', 'c', 'estados_civiles'),


                    ]
            ];
//dd($tabla);
//        //Estado
//        const EMPLEADO_ACTIVO = '1';
//        const EMPLEADO_INACTIVO = '2';
//        //Sexo
//        const EMPLEADO_MASCULINO = 'm';
//        const EMPLEADO_FEMENINO = 'f';
//        //Estado Civil
//        const EMPLEADO_CASADO = 'c';
//        const EMPLEADO_DIVORCIADO = 'd';
//        const EMPLEADO_VIUDO = 'v';
//        const EMPLEADO_SOLTERO = 's';
        $tabla2 =
            [
                'nombre' => 'empleados',
                'columnas' =>
                    [
                        'primarykeys' =>
                            [
                                'pk1' =>
                                    [
                                        'nombre' => 'id',
                                        'posicion' => 1,
                                        'tipo' => 'int',
                                        'longitud' => '10',
                                        'nulo' => 'no',
                                        'predeterminado' => 'autoincrement',
                                    ],
                            ],
                        'foreignkeys' =>
                            [
                                'fk1' => 'feriado',
                                'fk2' => 'calendario',
                            ],
                        'pk1' => 'feriado',
                        'fk1' => 'calendario',
                    ],
            ];

        $primarykeys =
            [
                'pk1' => 'Kprimario',
                'pk2' => 'Ksecundario',
            ];

        $foreignkeys =
            [
                'fk1' => 'primer foraneo',
                'fk2' => 'segundo foraneo',
            ];

        $columnas =
            [
                'columna1' =>
                    [
                        'descripcion' => 'c1 columna',
                        'tipo' => 'numerico',
                    ],
                'columna2' =>
                    [
                        'descripcion' => 'c2columna',
                        'tipo' => 'text',
                    ],
            ];
        $thedat =
            [
                '001' => '002',

            ];

        $var = Blade::compileString('
<script type=\'text/javascript\'>
var variable = \'<?= $variable ?>\';
</script>');

        $gen->dat = '001';
        $gen->pk = $primarykeys;
        $gen->fk = $foreignkeys;
        $gen->cols = $columnas;
        $gen->var = $var;
        $gen->tabla = $tabla;

        return view('_template.matrix', compact('gen', $gen)); // Lista con BelongsTo
    }
}




//$var = Blade::compileString('
//<script type=\'text/javascript\'>
/*var variable = \'<?= $variable ?>\';*/
//</script>');
//
//$var = Blade::compileString('
//<?php
//$a = array(\'a\' => 1, \'b\' => 2, 3 => \'c\');
//
//echo "$a[a] ${a[3] /* } comment */} {$a[b]} \ $a[a]";
//
//function hello($who) {
//	return "Hello $who!";
//}
//? >
