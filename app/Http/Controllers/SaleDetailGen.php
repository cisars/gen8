<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class SaleDetailGen extends Controller
{
    public function index()
    {

        $gen = new stdClass();
        $genisa = new MakeTemplateController();
        $tabla      =
            [
                'ZNOMBRESZ'   => 'SalesDetails' ,
                'ZNOMBREZ'    => 'SaleDetail' ,
                'ZnombresZ'   => 'sale_details' ,
                'ZnombreZ'    => 'sale_detail' ,
                'columnas'  =>
                    [
                        $genisa->parametros('id',              'hidden',    'int', '' ,  'notnull', 'pk', 'autoincrement','','','',''),
                        $genisa->parametros('sale_id',     'Venta ID',      'int',  '',   'notnull','fk','',
                            'Sale','sales','sale','invoice_number',''),
                        $genisa->parametros('product_id',       'Producto ID',      'int',  '',   'notnull','fk','',
                            'Product','products','product',    'name',''),

                        $genisa->parametros('price_cost', 'Precio de Costo',  'int',      '',   'notnull','','','','','','',''),
                        $genisa->parametros('price_sale', 'Precio de Venta',  'int',      '',   'notnull','','','','','','',''),
                        $genisa->parametros('quantity',   'Cantidad',         'int',      '',   'notnull','','','','','','',''),
                        $genisa->parametros('subtotal',   'SubTotal',         'int',      '',   'notnull','','','','','','',''),
                        $genisa->parametros('total',      'Total',            'int',      '',   'notnull','','','','','','',''),
                        $genisa->parametros('tax_10',     'Impuesto 10%',     'decimal',  '',   'notnull','','','','','','',''),
                        $genisa->parametros('tax_5',      'Impuesto 5%',      'decimal',  '',   'notnull','','','','','','',''),

                    ],
                'relaciones'  =>
                    [
                        $genisa->foreign('sale_id','id','sales','CASCADE','CASCADE',
                            'sale', 'belongsTo', 'Sale::class', 'sale_id','', ''),
                        $genisa->foreign('product_id','id','products','CASCADE','CASCADE',
                            'product', 'belongsTo', 'Product::class', 'product_id','', ''),

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
