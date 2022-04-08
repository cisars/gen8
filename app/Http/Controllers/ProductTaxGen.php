<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class ProductTaxGen extends Controller
{
    public function index()
    {

        $gen = new stdClass();
        $genisa = new MakeTemplateController();
        $tabla      =
            [
                'ZNOMBRESZ'   => 'ProductsTaxes' ,
                'ZNOMBREZ'    => 'ProductTax' ,
                'ZnombresZ'   => 'product_taxes' ,
                'ZnombreZ'    => 'product_tax' ,
                'columnas'  =>
                    [
                        $genisa->parametros('id',              'hidden',    'int', '' ,  'notnull', 'pk', 'autoincrement','','','',''),
                        $genisa->parametros('product_id',       'Producto ID',      'int',      '',   'notnull','fk','',
                            'Product','products','product',    'name',''),
                        $genisa->parametros('tax_id',           'Impuestos',      'int',        '',   'notnull','fk','',
                            'Tax','taxes','tax','name',''),
                        $genisa->parametros('tax_10',            'Impuesto 10%', 'decimal',     '',   'notnull','','','','','','',''),
                        $genisa->parametros('tax_5',            'Impuesto 5%',   'decimal',      '',   'notnull','','','','','','',''),
                        $genisa->parametros('tax_excempt',      'Excenta',       'decimal',        '',   'notnull','','','','','','',''),

                    ],
                'relaciones'  =>
                    [
                        $genisa->foreign('product_id','id','products','CASCADE','CASCADE',
                            'product', 'belongsTo', 'Product::class', 'product_id','', ''),

                        $genisa->foreign('tax_id','id','taxes','CASCADE','CASCADE',
                            'tax', 'belongsTo', 'Tax::class', 'tax_id','', ''),

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
