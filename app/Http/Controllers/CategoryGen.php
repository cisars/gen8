<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class CategoryGen extends Controller
{
    public function index()
    {

        $gen = new stdClass();
        $genisa = new MakeTemplateController();
        $tabla      =
            [
                'ZNOMBRESZ'   => 'Categories' ,
                'ZNOMBREZ'    => 'Category' ,
                'ZnombresZ'   => 'categories' ,
                'ZnombreZ'    => 'category' ,
                'columnas'  =>
                    [
                        $genisa->parametros('id',               'hidden',               'smallint', '' ,   'notnull', 'pk', 'autoincrement','','','',''),
                        $genisa->parametros('name',             'Nombre',               'text',      '100', 'notnull','','','','','','',''),
                        $genisa->parametros('description',      'Descripcion',          'text',  '100',     'notnull','','','','','','',''),

                    ],
                'relaciones'  =>
                    [


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
