<?php

namespace App\Http\Controllers;

use stdClass;

class CompanyGen extends Controller
{
    public function index()
    {

        $gen = new stdClass();
        $genisa = new MakeTemplateController();
        $tabla      =
            [
                'ZNOMBRESZ'   => 'Companies' ,
                'ZNOMBREZ'    => 'Company' ,
                'ZnombresZ'   => 'companies' ,
                'ZnombreZ'    => 'company' ,
                'columnas'  =>
                    [
                        $genisa->parametros('id',               'hidden',               'smallint', '' ,  'notnull', 'pk', 'autoincrement','','','',''),
                        $genisa->parametros('name',             'Nombre',               'text',      '',   'notnull','','','','','','',''),
                        $genisa->parametros('document',         'Documento',            'varchar',  '20',   'notnull','','','','','','',''),
                        $genisa->parametros('address',          'Direccion',            'varchar',  '80',   'notnull','','','','','','',''),
                        $genisa->parametros('city',             'Ciudad',               'varchar',  '80',   'notnull','','','','','','',''),
                        $genisa->parametros('document_type',    'Tipo de Documeno',     'enum',     '',     'notnull','','','','','','','',
                        'documents_types','CompanyDocumentType'),
                        $genisa->parametros('phone',            'Teléfono',             'varchar',  '20',   'notnull','','','','','','',''),
                        $genisa->parametros('email',            'Email',                'varchar',  '80',   'notnull','','','','','','',''),


                    ],
                'relaciones'  =>
                    [


                    ],
                'enumCol'  =>
                    [
                        $genisa->enumCol('document_type',  'CI',    	      'CI'  ),
                        $genisa->enumCol('document_type',  'RUC',    		  'RUC'  ),
                        $genisa->enumCol('document_type',  'PASAPORTE',     'Pasaporte'  ),

                    ],
                'constantes'  =>
                    [

                        $genisa->constantes('document_type',  'CI',    	      'C' , 'documents_types',    'CI', 	    'CI'),
                        $genisa->constantes('document_type',  'RUC',    		  'R' , 'documents_types',    'RUC', 		'RUC'	),
                        $genisa->constantes('document_type',  'PASAPORTE',     'P' , 'documents_types',    'Pasaporte ', 	'Pasaporte'	),

                    ]

            ];
        $gen->dat = '001';
        $gen->tabla = $tabla;
        return view('_template.matrix', compact('gen')); // Lista con BelongsTo
    }
}
