<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class ProductGen extends Controller
{
    public function index()
    {

        $gen = new stdClass();
        $genisa = new MakeTemplateController();
        $tabla      =
            [
                'ZNOMBRESZ'   => 'Products' ,
                'ZNOMBREZ'    => 'Product' ,
                'ZnombresZ'   => 'products' ,
                'ZnombreZ'    => 'product' ,
                'columnas'  =>
                    [
                        $genisa->parametros('id',              'hidden',        'int', '' ,  'notnull', 'pk', 'autoincrement','','','',''),
                        $genisa->parametros('company_id',     'Company',      'int',  '',   'notnull','fk','',
                            'Company','companies','company','name','name'),

                        $genisa->parametros('category_id',     'Categoria',      'int',  '',   'notnull','fk','',
                            'Category','categories','category','name','name'),
                        $genisa->parametros('supplier_id',       'Proveedor',      'int',  '',   'notnull','fk','',
                            'Supplier','suppliers','supplier',    'name','name'),
                        $genisa->parametros('measure_id',       'Medida',      'int',  '',   'notnull','fk','',
                            'Measure','measures','measure',    'name','name'),
                        $genisa->parametros('tax_id',           'Impuesto',      'int',  '',   'notnull','fk','',
                            'Tax','taxes','tax',            'name','name'),
                        $genisa->parametros('name',                 'Nombre', 'text', '200',   'notnull','','','','','','',''),
                         $genisa->parametros('price_cost',        'Precio de Costo',      'int',    '',   'notnull','','','','','','',''),
                        $genisa->parametros('price_sale',            'Precio de Venta',      'int',    '',   'notnull','','','','','','',''),
                        $genisa->parametros('exempt',            'Excentas',      'decimal',    '',   '','','','','','','',''),
                        $genisa->parametros('active',           'Activo',           'boolean',  '',   'notnull','','','','','','',''),
                        $genisa->parametros('stock',            'Existencia',      'int',    '',   'notnull','','','','','','',''),

                    ],
                'relaciones'  =>
                    [
                        $genisa->parametros('company_id',     'Company',      'int',  '',   'notnull','fk','',
                            'Company','companies','company','name','name'),
                        $genisa->foreign('category_id','id','categories','CASCADE','CASCADE',
                            'category', 'belongsTo', 'Category::class', 'category_id','', ''),
                        $genisa->foreign('supplier_id','id','suppliers','CASCADE','CASCADE',
                            'supplier', 'belongsTo', 'Supplier::class', 'supplier_id','', ''),
                        $genisa->foreign('measure_id','id','measures','CASCADE','CASCADE',
                            'measure', 'belongsTo', 'Measure::class', 'measure_id','', ''),
                        $genisa->foreign('tax_id','id','taxes','CASCADE','CASCADE',
                            'tax', 'belongsTo', 'Tax::class', 'tax_id','', ''),
//                        $genisa->foreign('tax_id','id','product_taxes','CASCADE','CASCADE',
//                            'tax', 'belongsToMany', 'ProductTax::class', 'tax_id','product_id', 'ProductTax'),

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
