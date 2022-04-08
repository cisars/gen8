<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class DetailInstallmentGen extends Controller
{
    public function index()
    {

        $gen = new stdClass();
        $genisa = new MakeTemplateController();
        $tabla      =
            [
                'ZNOMBRESZ'   => 'DetailsInstallments' ,
                'ZNOMBREZ'    => 'DetailInstallment' ,
                'ZnombresZ'   => 'detail_installments' ,
                'ZnombreZ'    => 'detail_installment' ,
                'columnas'  =>
                    [
                        $genisa->parametros('id',               'hidden',               'int', '' ,  'notnull', 'pk', 'autoincrement','','','',''),
                        $genisa->parametros('installment_id',     'Cuota',             'int',  '',   'notnull','fk','',
                            'Installment','installments','installment','id',''),
                        $genisa->parametros('module_id',     'Modulo',            'int',  '',   'notnull','fk','',
                            'Module','modules','module','name',''),
                        $genisa->parametros('price',            'Precio',              'int',  '',   'notnull','','','','','','',''),
                        $genisa->parametros('discount',             'Descuento',    'int',  '',   'notnull','','','','','','',''),
                        $genisa->parametros('total',                'Total',        'int',  '',   'notnull','','','','','','',''),

                    ],
                'relaciones'  =>
                    [
                        $genisa->foreign('installment_id','id','installments','CASCADE','CASCADE',
                            'installment', 'belongsTo', 'Installment::class', 'installment_id','', ''),
                        $genisa->foreign('module_id','id','modules','CASCADE','CASCADE',
                            'module', 'belongsTo', 'Module::class', 'module_id','', ''),

                    ],
                'constantes'  =>
                    [

                    ]

            ];
        $gen->dat = '001';
        $gen->tabla = $tabla;
        if (isset($bandera)){
         //   return  $gen->tabla = $tabla;
        }
        return view('_template.matrix', compact('gen')); // Lista con BelongsTo
    }
}
