<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class InstallmentGen extends Controller
{

    public function index($bandera = false)
    {

        $gen = new stdClass();
        $genisa = new MakeTemplateController();
        $tabla      =
            [
                'ZNOMBRESZ'   => 'Installments' ,
                'ZNOMBREZ'    => 'Installment' ,
                'ZnombresZ'   => 'installments' ,
                'ZnombreZ'    => 'installment' ,
                'columnas'  =>
                    [
                        $genisa->parametros('id',               'hidden',               'int', '' ,  'notnull', 'pk', 'autoincrement','','','',''),
                        $genisa->parametros('membership_id',     'Membership',            'int',  '',   'notnull','fk','',
                            'Membership','memberships','membership','id',''),
                        $genisa->parametros('payment_method',    'Metodo de Pago',       'enum', '', 'notnull','','','','','','','', 'payment_methods', 'InstallmentPaymentMethod'),
                        $genisa->parametros('state',            'Estado',                'enum', '', 'notnull','','','','','','','', 'states', 'InstallmentState'),
                        $genisa->parametros('expiration',       'Vencimiento',           'date',     '20',  'null','','','','','','',''),

                    ],
                'relaciones'  =>
                    [
                        $genisa->foreign('membership_id','id','memberships','CASCADE','CASCADE',
                            'membership', 'belongsTo', 'Membership::class', 'membership_id','', ''),

                    ],

                'enumCol'  =>
                    [

                        $genisa->enumCol('state',     'ESTADO_ACTIVO',      'Activo'),
                        $genisa->enumCol('state',     'ESTADO_INACTIVO',    'Inactivo'),
                        $genisa->enumCol('state',     'ESTADO_ESPERA',     'Espera'),
                        $genisa->enumCol('state',     'ESTADO_CANCELADO',   'Cancelado'),
                        $genisa->enumCol('state',     'ESTADO_PENDIENTE',   'Pendiente'),

                        $genisa->enumCol('payment_method',  'DEBITO',      'Debito' ),
                        $genisa->enumCol('payment_method',  'CREDITO',     'Credito'  ),
                        $genisa->enumCol('payment_method',  'EFECTIVO',    'Efectivo' ),
                        $genisa->enumCol('payment_method',  'CHEQUE',      'Cheque' ),

                    ],

                'constantes'  =>
                    [

                        $genisa->constantes('state',     'ESTADO_ACTIVO',    	    '1' , 'states',    'Activo', 	    'Activo'),
                        $genisa->constantes('state',     'ESTADO_INACTIVO',       '2' , 'states',    'Inactivo',    'Inactivo'	),
                        $genisa->constantes('state',     'ESTADO_ESPERA',    	    '3' , 'states',    'Espera', 	    'Espera'	),
                        $genisa->constantes('state',     'ESTADO_CANCELADO',    	'4' , 'states',    'Cancelado', 	'Cancelado'),
                        $genisa->constantes('state',     'ESTADO_PENDIENTE',    	'5' , 'states',    'Pendiente', 	'Pendiente'	),

                        $genisa->constantes('payment_method',  'DEBITO',    	  '1' , 'payment_methods',    'Debito', 	    'Debito'),
                        $genisa->constantes('payment_method',  'CREDITO',    	  '2' , 'payment_methods',    'Credito', 		'Credito'),
                        $genisa->constantes('payment_method',  'EFECTIVO',       '3' , 'payment_methods',    'Efectivo', 	'Efectivo'),
                        $genisa->constantes('payment_method',  'CHEQUE',         '4' , 'payment_methods',    'Cheque', 	    'Cheque'),

                    ]

            ];

        $gen->dat = '001';
        $gen->tabla = $tabla;
        if (isset($bandera)){
        //    return  $tabla;
        }
        return view('_template.matrix', compact('gen')); // Lista con BelongsTo
    }
}
