<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class SupplierGen extends Controller
{
    public function index()
    {

        $gen = new stdClass();
        $genisa = new MakeTemplateController();
        $tabla      =
            [
                'ZNOMBRESZ'   => 'Suppliers' ,
                'ZNOMBREZ'    => 'Supplier' ,
                'ZnombresZ'   => 'suppliers' ,
                'ZnombreZ'    => 'supplier' ,
                'columnas'  =>
                    [
                        $genisa->parametros('id',               'hidden',      'int',  '' ,  'notnull', 'pk', 'autoincrement','','','',''),
                        $genisa->parametros('company_id',     'Company',      'int',  '',   'notnull','fk','',
                            'Company','companies','company','name','name'),

                        $genisa->parametros('name',             'Nombre',      'text',  '20',   'notnull','','','','','','',''),
                        $genisa->parametros('description',      'Descripcion',      'text',  '100',   'notnull','','','','','','',''),
                        $genisa->parametros('address',          'Direccion',      'text',  '100',   'notnull','','','','','','',''),
                        $genisa->parametros('city',             'Ciudad',      'text',  '20',   'notnull','','','','','','',''),
                        $genisa->parametros('phone_number',     'Telefono',      'text',  '20',   'notnull','','','','','','',''),

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
