<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class ClientGen extends Controller
{
    public function index()
    {

        $gen = new stdClass();
        $genisa = new MakeTemplateController();
        $tabla      =
            [
                'ZNOMBRESZ'   => 'Clients' ,
                'ZNOMBREZ'    => 'Client' ,
                'ZnombresZ'   => 'clients' ,
                'ZnombreZ'    => 'client' ,
                'columnas'  =>
                    [
                        $genisa->parametros('id',               'hidden',      'int',  '' ,  'notnull', 'pk', 'autoincrement','','','',''),
                        $genisa->parametros('company_id',     'Company',      'int',  '',   'notnull','fk','',
                            'Company','companies','company','name','name'),
                        $genisa->parametros('name',             'Nombre',      'text',  '50',   'notnull','','','','','','',''),
                        $genisa->parametros('first_name',       'Primer Nombre', 'text',  '50',   'notnull','','','','','','',''),
                        $genisa->parametros('last_name',        'Apellido',      'text',  '50',   'notnull','','','','','','',''),
                        $genisa->parametros('document_type','Tipo de Documento', 'enum',  '',   'notnull','','','','','','','',
                            'documents_types','ClientDocumentType'),
                        $genisa->parametros('document_number',  'Nro de Documento','text',  '20',   'notnull','','','','','','',''),
                        $genisa->parametros('address',         'Direccion',      'text',  '100',   'notnull','','','','','','',''),
                        $genisa->parametros('city',             'Ciudad',          'text',  '50',   'notnull','','','','','','',''),
                        $genisa->parametros('phone',             'Telefono',      'text',  '50',   'notnull','','','','','','',''),
                        $genisa->parametros('email',             'Email',         'text',  '50',   'notnull','','','','','','',''),

                    ],
                'relaciones'  =>
                    [
                        $genisa->foreign('company_id','id','companies','CASCADE','CASCADE',
                            'company', 'belongsTo', 'Company::class', 'company_id','', ''),
                    ],
                'enumCol'  =>
                    [
                        $genisa->enumCol('document_type',  'CI',    	      'CI'  ),
                        $genisa->enumCol('document_type',  'RUC',    		  'RUC'  ),
                        $genisa->enumCol('document_type',  'PASAPORTE',     'Pasaporte'  ),

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
