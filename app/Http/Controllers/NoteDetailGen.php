<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class NoteDetailGen extends Controller
{
    public function index()
    {
        $gen = new stdClass();
        $genisa = new MakeTemplateController();
        $tabla      =
            [
                'ZNOMBRESZ'   => 'NotesDetails' ,
                'ZNOMBREZ'    => 'NoteDetail' ,
                'ZnombresZ'   => 'note_details' ,
                'ZnombreZ'    => 'note_detail' ,
                'columnas'  =>
                    [
                        $genisa->parametros('id',               'hidden',               'int', '' ,  'notnull', 'pk', 'autoincrement','','','',''),
                        $genisa->parametros('note_id',          'Factura Numero',       'int',  '',   'notnull','fk','',
                            'Note','notes','note','id',''),
                        $genisa->parametros('product_id',          'Producto ID',       'int',  '',   'notnull','fk','',
                            'Product','products','product','name',''),

                        $genisa->parametros('description',        'Descripcion',        'text',  '100',  'notnull','','','','','','',''),
                        $genisa->parametros('price_cost',        'Precio Costo',     'int',   '',  'notnull','','','','','','',''),
                        $genisa->parametros('price_sale',        'Precio Venta',     'int',   '',  'notnull','','','','','','',''),
                        $genisa->parametros('quantity',          'Cantidad',            'int',   '',  'notnull','','','','','','',''),
                        $genisa->parametros('amount',            'Monto',               'int',   '',  'notnull','','','','','','',''),
                    ],

                'relaciones'  =>
                    [
                        $genisa->foreign('note_id','id','notes','CASCADE','CASCADE',
                            'note', 'belongsTo', 'Note::class', 'note_id','', ''),
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
        return view('_template.matrix', compact('gen' )); // Lista con BelongsTo
    }
}

