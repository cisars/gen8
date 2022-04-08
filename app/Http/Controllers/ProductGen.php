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
                        $genisa->parametros('category_id',     'Categoria',      'int',  '',   'notnull','fk','',
                            'Category','categories','category','name','name'),
                        $genisa->parametros('supplier_id',       'Proveedor',      'int',  '',   'notnull','fk','',
                            'Supplier','suppliers','supplier',    'name','name'),
                        $genisa->parametros('measure_id',       'Medida',      'int',  '',   'notnull','fk','',
                            'Measure','measures','measure',    'name','name'),
                        $genisa->parametros('name',                 'Nombre', 'text', '200',   'notnull','','','','','','',''),
                         $genisa->parametros('price_cost',        'Precio de Costo',      'int',    '',   'notnull','','','','','','',''),
                        $genisa->parametros('price_sale',            'Precio de Venta',      'int',    '',   'notnull','','','','','','',''),
                        $genisa->parametros('active',           'Activo',                   'boolean',  '',   'notnull','','','','','','',''),
                        $genisa->parametros('stock',            'Stock',      'int',    '',   'notnull','','','','','','',''),
                         $genisa->parametros('tax_amount_10',    'Impuesto 10%', 'int',    '',   'notnull','','','','','','',''),
                        $genisa->parametros('tax_amount_5',    'Impuesto 5%',  'int',    '',   'notnull','','','','','','',''),
                        $genisa->parametros('tax_amount_excempt','Excentas', 'int',    '',   'notnull','','','','','','',''),

                    ],
                'relaciones'  =>
                    [
                        $genisa->foreign('category_id','id','categories','CASCADE','CASCADE',
                            'category', 'belongsTo', 'Category::class', 'category_id','', ''),
                        $genisa->foreign('supplier_id','id','suppliers','CASCADE','CASCADE',
                            'supplier', 'belongsTo', 'Supplier::class', 'supplier_id','', ''),
                        $genisa->foreign('measure_id','id','measures','CASCADE','CASCADE',
                            'measure', 'belongsTo', 'Measure::class', 'measure_id','', ''),

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
