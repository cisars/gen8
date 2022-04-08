<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class MovementGen extends Controller
{
    public function index()
    {

        $gen = new stdClass();
        $genisa = new MakeTemplateController();
        $tabla      =
            [
                'ZNOMBRESZ'   => 'Movements' ,
                'ZNOMBREZ'    => 'Movement' ,
                'ZnombresZ'   => 'movements' ,
                'ZnombreZ'    => 'movement' ,
                'columnas'  =>
                    [
                        $genisa->parametros('id',              'hidden',                'int', '' ,  'notnull', 'pk', 'autoincrement','','','',''),
                        $genisa->parametros('purchase_id',       'Compra ID',        'int',      '',   'notnull','fk','',
                            'Purchase','purchases','purchase',    'purchase_order_number',''),
                        $genisa->parametros('sale_id',       'Venta ID',          'int',      '',   'notnull','fk','',
                            'Sale','sales','sale',    'invoice_number',''),

                        $genisa->parametros('direction',        'Direccion',    'enum',  '',  'notnull','','','','','','','',
                            'directions', 'MovementDirection'),
                        $genisa->parametros('quantity',             'Cantidad',         'int',          '',   'notnull','','','','','','',''),

                    ],
                'relaciones'  =>
                    [
                        $genisa->foreign('purchase_id','id','purchases','CASCADE','CASCADE',
                            'purchase', 'belongsTo', 'Purchase::class', 'purchase_id','', ''),
                        $genisa->foreign('sale_id','id','sales','CASCADE','CASCADE',
                            'sale', 'belongsTo', 'Sale::class', 'sale_id','', ''),

                    ],
                'enumCol'  =>
                    [
                        $genisa->enumCol('direction',           'ENTRADA',     'Entrada' ),
                        $genisa->enumCol('direction',           'SALIDA',     'Salida' ),
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
