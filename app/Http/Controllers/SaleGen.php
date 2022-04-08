<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class SaleGen extends Controller
{
    public function index()
    {

        $gen = new stdClass();
        $genisa = new MakeTemplateController();
        $tabla      =
            [
                'ZNOMBRESZ'   => 'Sales' ,
                'ZNOMBREZ'    => 'Sale' ,
                'ZnombresZ'   => 'sales' ,
                'ZnombreZ'    => 'sale' ,
                'columnas'  =>
                    [
                        $genisa->parametros('id',              'hidden',    'int', '' ,  'notnull', 'pk', 'autoincrement','','','',''),
                        $genisa->parametros('company_id',     'Company',      'int',  '',   'notnull','fk','',
                            'Company','companies','company','name','name'),
                        $genisa->parametros('invoice_number',  'Factura',      'varchar',  '255',   'notnull','fk','',
                            'Invoice','invoices','invoice','invoice_number','invoice_number'),
                        $genisa->parametros('client_id',       'Cliente',      'int',  '',   'notnull','fk','',
                            'Client','clients','client',    'name','name'),

                        $genisa->parametros('date',             'Fecha',      'date',      '',   'notnull','','','','','','',''),
                        $genisa->parametros('subtotal',        'SubTotal',      'int',    '',   'notnull','','','','','','',''),
                        $genisa->parametros('total',            'Total',      'int',    '',   'notnull','','','','','','',''),
                        $genisa->parametros('total_letters',    'Total en letras', 'text', '300',   'notnull','','','','','','',''),
                        $genisa->parametros('tax_amount_10',    'Impuesto 10%', 'decimal',    '',   'notnull','','','','','','',''),
                        $genisa->parametros('tax_amount_5',     'Impuesto 5%',  'decimal',    '',   'notnull','','','','','','',''),
                        $genisa->parametros('tax_amount_excempt','Excenta',    'decimal',    '',   'notnull','','','','','','',''),
                        $genisa->parametros('general_state',        'Estado General',   'enum',  '',  'notnull','','','','','','','',
                            'general_states', 'SaleGeneralState'),
                        $genisa->parametros('payment_state',        'Estados de Pago',  'enum',  '',  'notnull','','','','','','','',
                            'payments_states', 'SalePaymentState'),

                    ],
                'relaciones'  =>
                    [
                        $genisa->foreign('company_id','id','companies','CASCADE','CASCADE',
                            'company', 'belongsTo', 'Company::class', 'company_id','', ''),
                        $genisa->foreign('invoice_number','invoice_number','invoices','CASCADE','CASCADE',
                            'invoice', 'belongsTo', 'Invoice::class', 'invoice_number','', ''),
                        $genisa->foreign('client_id','id','clients','CASCADE','CASCADE',
                            'client', 'belongsTo', 'Client::class', 'client_id','', ''),

                    ],
                'enumCol'  =>
                    [
                        $genisa->enumCol('general_state',           'ABIERTA',     'Abierta' ),
                        $genisa->enumCol('general_state',           'CERRADA',     'Cerrada' ),
                        $genisa->enumCol('general_state',           'CANCELADA',    'Cancelada' ),
                        $genisa->enumCol('payment_state',           'PENDIENTE',    'Pendiente' ),
                        $genisa->enumCol('payment_state',           'PAGADA',        'Pagada' ),
                        $genisa->enumCol('payment_state',           'REEMBOLSADO',   'Reembolsado' ),
                        $genisa->enumCol('payment_state',           'RECHAZADO',    'Rechazado' ),
                        $genisa->enumCol('payment_state',           'REINTENTO_DE_COBRO', 'Reintentando' ),
                        $genisa->enumCol('payment_state',           'IMPAGA',        'Impaga' ),

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
