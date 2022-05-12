<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class TaxGen extends Controller
{
    public function index()
    {

        $gen = new stdClass();
        $genisa = new MakeTemplateController();
        $tabla      =
            [
                'ZNOMBRESZ'   => 'Taxes' ,
                'ZNOMBREZ'    => 'Tax' ,
                'ZnombresZ'   => 'taxes' ,
                'ZnombreZ'    => 'tax' ,
                'columnas'  =>
                    [
                        $genisa->parametros('id',               'hidden',               'int', '' ,  'notnull', 'pk', 'autoincrement','','','',''),
                        $genisa->parametros('company_id',     'Company',      'int',  '',   'notnull','fk','',
                            'Company','companies','company','name','name'),

                        $genisa->parametros('name',             'Nombre',               'text',      '50',   'notnull','','','','','','',''),
                        $genisa->parametros('rate',             'Porcentaje',           'decimal',      '',   'notnull','','','','','','',''),
                        $genisa->parametros('active',           'Activo',               'boolean',  '',   'notnull','','','','','','',''),

                    ],
                'relaciones'  =>
                    [
                        $genisa->parametros('company_id',     'Company',      'int',  '',   'notnull','fk','',
                            'Company','companies','company','name','name'),

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
