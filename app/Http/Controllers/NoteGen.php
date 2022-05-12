<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class NoteGen extends Controller
{
    public function index()
    {
        $gen = new stdClass();
        $genisa = new MakeTemplateController();
        $tabla      =
            [
                'ZNOMBRESZ'   => 'Notes' ,
                'ZNOMBREZ'    => 'Note' ,
                'ZnombresZ'   => 'notes' ,
                'ZnombreZ'    => 'note' ,
                'columnas'  =>
                    [
                        $genisa->parametros('id',               'hidden',               'int', '' ,  'notnull', 'pk', 'autoincrement','','','',''),
                        $genisa->parametros('company_id',     'Company',      'int',  '',   'notnull','fk','',
                            'Company','companies','company','name','name'),

                        $genisa->parametros('invoice_number',     'Factura Numero',     'varchar',  '255',   'notnull','fk','',
                            'Invoices','invoices','invoice','id',''),
                        $genisa->parametros('client_id',       'Cliente',               'int',  '',   'notnull','fk','',
                            'Client','clients','client',    'name','name'),

                        $genisa->parametros('state',        'Estado',                    'enum',  '',  'notnull','','','','','','','',
                           'states', 'NoteState'),
                        $genisa->parametros('type',        'Tipo',                      'enum',  '',  'notnull','','','','','','','',
                            'types', 'NoteType'),

                    ],

                'relaciones'  =>
                    [
                        $genisa->parametros('company_id',     'Company',      'int',  '',   'notnull','fk','',
                            'Company','companies','company','name','name'),
                        $genisa->foreign('invoice_number','invoice_number','invoices','CASCADE','CASCADE',
                            'invoice', 'belongsTo', 'Invoice::class', 'invoice_number','', ''),
                        $genisa->foreign('client_id','id','clients','CASCADE','CASCADE',
                            'client', 'belongsTo', 'Client::class', 'client_id','', ''),


                    ],
                'enumCol'  =>
                    [

                        $genisa->enumCol('state',           'ACTIVO',          'Activo' ),
                        $genisa->enumCol('state',           'INACTIVO',        'Inactivo' ),
                        $genisa->enumCol('type',           'CREDITO',          'Credito' ),
                        $genisa->enumCol('type',           'DEBITO',        'Debito' ),


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

