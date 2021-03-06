<?php

namespace App\Http\Controllers;

use stdClass;

class CuotaGen extends Controller
{
    public function index()
    {

        $gen = new stdClass();
        $genisa = new MakeTemplateController();
        $tabla      =
            [
                'ZNOMBRESZ'   => 'Cuotas' ,
                'ZNOMBREZ'    => 'Cuota' ,
                'ZnombresZ'   => 'cuotas' ,
                'ZnombreZ'    => 'cuota' ,
                'columnas'  =>
                    [
                        $genisa->parametros('id',               'hidden',               'int', '' ,  'notnull', 'pk', 'autoincrement','','','',''),
                        $genisa->parametros('membership_id',     'Membership',            'int',  '',   'notnull','fk','',
                            'Membership','memberships','membership','id',''),
                        $genisa->parametros('payment_method',    'Metodo de Pago',       'enum', '', 'notnull','','','','','','','', 'payment_methods', 'InstallmentPaymentMethod'),
                        $genisa->parametros('state',            'Estado',                'enum', '', 'notnull','','','','','','','', 'states', 'InstallmentStates'),
                        $genisa->parametros('expiration',       'Vencimiento',           'enum', '', 'notnull','','','','','','','', 'expirations', 'InstallmentExpiration'),

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

                        $genisa->constantes('personeria',     'PERSONERIA_SOCIEDADES',    	's' , 'personerias',    'Personeria', 	'Sociedades'),
                        $genisa->constantes('personeria',     'PERSONERIA_CIVILES',    		'c' , 'personerias',    'Personeria', 		'Civiles'	),
                        $genisa->constantes('personeria',     'PERSONERIA_SIMPLES',    	'i' , 'personerias',    'Personeria ', 	'Simples '	),
                        $genisa->constantes('personeria',     'PERSONERIA_FUNDACIONES',    	'f' , 'personerias',    'Personeria', 	'Fundaciones'),
                        $genisa->constantes('personeria',     'PERSONERIA_ENTIDADES',    	'e' , 'personerias',    'Personeria', 	'Entidades'	),
                        $genisa->constantes('personeria',     'PERSONERIA_MUTUALES',    	'm' , 'personerias',    'Personeria', 	'Mutuales'	),
                        $genisa->constantes('personeria',     'PERSONERIA_COOPERATIVAS',    'o' , 'personerias',    'Personeria', 'Cooperativas'),
                        $genisa->constantes('personeria',     'PERSONERIA_CONSORCIOS',    	'n' , 'personerias',    'Personeria', 	'Consorcios'),

                    ]

            ];
        $gen->dat = '001';
        $gen->tabla = $tabla;
        return view('_template.matrix', compact('gen')); // Lista con BelongsTo
    }
}
