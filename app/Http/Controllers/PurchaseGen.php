<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class PurchaseGen extends Controller
{
    public function index()
    {

        $gen = new stdClass();
        $genisa = new MakeTemplateController();
        $tabla      =
            [
                'ZNOMBRESZ'   => 'Purchases' ,
                'ZNOMBREZ'    => 'Purchase' ,
                'ZnombresZ'   => 'purchases' ,
                'ZnombreZ'    => 'purchase' ,
                'columnas'  =>
                    [
                        $genisa->parametros('id',              'hidden',                'int', '' ,  'notnull', 'pk', 'autoincrement','','','',''),
                        $genisa->parametros('company_id',     'Company',      'int',  '',   'notnull','fk','',
                            'Company','companies','company','name','name'),

                        $genisa->parametros('supplier_id',       'Proveedor ID',        'int',      '',   'notnull','fk','',
                            'Supplier','suppliers','supplier',    'name',''),
                        $genisa->parametros('product_id',       'Producto ID',          'int',      '',   'notnull','fk','',
                            'Product','products','product',    'name',''),

                        $genisa->parametros('purchase_order_number', 'Nro de compra',   'varchar',     '255',   'notnull','','','','','','',''),
                        $genisa->parametros('quantity',             'Cantidad',         'int',          '',   'notnull','','','','','','',''),
                        $genisa->parametros('datetime',            'Fecha y Hora',      'timestamp',    '',   'notnull','','','','','','',''),

                    ],
                'relaciones'  =>
                    [
                        $genisa->parametros('company_id',     'Company',      'int',  '',   'notnull','fk','',
                            'Company','companies','company','name','name'),
                         $genisa->foreign('supplier_id','id','suppliers','CASCADE','CASCADE',
                            'supplier', 'belongsTo', 'Supplier::class', 'supplier_id','', ''),
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
