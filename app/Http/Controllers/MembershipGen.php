<?php

namespace App\Http\Controllers;

use stdClass;

class MembershipGen extends Controller
{

    public function index()
    {

        $gen = new stdClass();
        $genisa = new MakeTemplateController();
        $tabla      =
            [
                'ZNOMBRESZ'   => 'Memberships' ,
                'ZNOMBREZ'    => 'Membership' ,
                'ZnombresZ'   => 'memberships' ,
                'ZnombreZ'    => 'membership' ,
                'columnas'  =>
                    [
                        $genisa->parametros('id',           'hidden',                'int', '' ,  'notnull', 'pk', 'autoincrement','','','',''),

                        $genisa->parametros('company_id',      'Empresa',            'int',  '',   'notnull','fk','',
                            'Company','companies','company','name',''),
                        $genisa->parametros('user_id',      'User',                  'int',  '',   'notnull','fk','',
                            'User','users','user','name',''),

                        $genisa->parametros('document_type',    'Tipo de Documeno',  'enum',     '',    'notnull','','','','','','','','documents_types', 'MembershipDocumentType'),
                        $genisa->parametros('payment_method',    'Metodo de Pago',   'enum',     '',    'notnull','','','','','','','','payment_methods', 'MembershipPaymentMethod'),

                        $genisa->parametros('document',     'Documento',             'text',  '100',   'null','','','','','','',''),
                        $genisa->parametros('description',  'Descripcion',           'text',  '100',   'null','','','','','','',''),
                        $genisa->parametros('date_start',   'Fecha de Inicio',       'date',     '',   'null','','','','','','',''),
                        $genisa->parametros('date_end',     'Fecha de Finalizacion', 'date',    '',   'null','','','','','','',''),
                        $genisa->parametros('state',        'Estado',                'enum',     '',   'notnull','','','','','','','','states', 'MembershipState'),
                    ],

                'relaciones'  =>
                    [
                        $genisa->foreign('user_id','id','users','CASCADE','CASCADE',
                            'user', 'belongsTo', 'User::class', 'user_id','', ''),
                        $genisa->foreign('company_id','id','companies','CASCADE','CASCADE',
                            'company', 'belongsTo', 'Company::class', 'company_id','', ''),
                        $genisa->foreign('membership_id','id','memberships_modules','CASCADE','CASCADE',
                            'membership', 'belongsToMany', 'MembershipModule::class', 'membership_id','module_id', 'MembershipModule'),
                        $genisa->foreign('membership_id','id','users_modules','CASCADE','CASCADE',
                            'membership', 'belongsToMany', 'UserModule::class', 'membership_id','user_id', 'MembershipModule'),
                    ],
                'enumCol'  =>
                    [
                        $genisa->enumCol('state',           'ACTIVO',        'Activo' ),
                        $genisa->enumCol('state',           'INACTIVO',      'Inactivo' ),
                        $genisa->enumCol('document_type',   'CI',    	     'CI' ),
                        $genisa->enumCol('document_type',   'RUC',    		 'RUC' ),
                        $genisa->enumCol('document_type',   'PASAPORTE',    'Pasaporte' ),
                        $genisa->enumCol('payment_method',  'DEBITO',    	 'Debito' ),
                        $genisa->enumCol('payment_method',  'CREDITO',       'Credito' ),
                        $genisa->enumCol('payment_method',  'EFECTIVO',      'Efectivo' ),
                        $genisa->enumCol('payment_method',  'CHEQUE',        'Cheque' ),
                    ],
                'constantes'  =>
                    [
                        $genisa->constantes('state',           'ACTIVO',        'a' , 'states',             'Activo', 	    'Activo'),
                        $genisa->constantes('state',           'INACTIVO',      'i' , 'states',             'Inactivo',       'Inactivo'),
                        $genisa->constantes('document_type',   'CI',    	      'C' , 'documents_types',    'CI', 	        'CI'),
                        $genisa->constantes('document_type',   'RUC',    		  'R' , 'documents_types',    'RUC', 		    'RUC'),
                        $genisa->constantes('document_type',   'PASAPORTE',     'P' , 'documents_types',    'Pasaporte ', 	'Pasaporte'),
                        $genisa->constantes('payment_method',  'DEBITO',    	  '1' , 'payment_methods',    'Debito', 	    'Debito'),
                        $genisa->constantes('payment_method',  'CREDITO',    	  '2' , 'payment_methods',    'Credito', 		'Credito'),
                        $genisa->constantes('payment_method',  'EFECTIVO',       '3' , 'payment_methods',    'Efectivo', 	'Efectivo'),
                        $genisa->constantes('payment_method',  'CHEQUE',         '4' , 'payment_methods',    'Cheque', 	    'Cheque'),
                    ]
            ];
        $gen->dat = '001';
        $gen->tabla = $tabla;
        return view('_template.matrix', compact('gen')); // Lista con BelongsTo
    }
}

