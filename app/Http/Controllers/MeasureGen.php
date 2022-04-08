<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class MeasureGen extends Controller
{
    public function index()
    {

        $gen = new stdClass();
        $genisa = new MakeTemplateController();
        $tabla      =
            [
                'ZNOMBRESZ'   => 'Measures' ,
                'ZNOMBREZ'    => 'Measure' ,
                'ZnombresZ'   => 'measures' ,
                'ZnombreZ'    => 'measure' ,
                'columnas'  =>
                    [
                        $genisa->parametros('id',               'hidden',      'int',  '' ,  'notnull', 'pk', 'autoincrement','','','',''),
                        $genisa->parametros('company_id',     'Company',      'int',  '',   'notnull','fk','',
                            'Company','companies','company','name','name'),
                        $genisa->parametros('name',             'Nombre',      'text',  '50',   'notnull','','','','','','',''),
                          $genisa->parametros('unit',            'Unidad',      'varchar',    '5',   'notnull','','','','','','',''),

                    ],
                'relaciones'  =>
                    [
                        $genisa->foreign('company_id','id','companies','CASCADE','CASCADE',
                            'company', 'belongsTo', 'Company::class', 'company_id','', ''),
                    ],
                'enumCol'  =>
                    [


                    ],
                'constantes'  =>
                    [

                    ]

            ];
        $gen->dat = '001';
        $gen->tabla = $tabla;
        return view('_template.matrix', compact('gen')); // Lista con BelongsTo
    }
}
