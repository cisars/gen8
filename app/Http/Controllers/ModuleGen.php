<?php

namespace App\Http\Controllers;

use stdClass;

class ModuleGen extends Controller
{
    public function index()
    {

        $gen = new stdClass();
        $genisa = new MakeTemplateController();
        $tabla      =
            [
                'ZNOMBRESZ'   => 'Modules' ,
                'ZNOMBREZ'    => 'Module' ,
                'ZnombresZ'   => 'modules' ,
                'ZnombreZ'    => 'module' ,
                'columnas'  =>
                    [
                        $genisa->parametros('id',               'hidden',               'int', '' ,  'notnull', 'pk', 'autoincrement','','','',''),
                        $genisa->parametros('name',             'Nombre',              'text',  '20',   'notnull','','','','','','',''),
                        $genisa->parametros('description',     'Descripcion',          'text',  '150',   'notnull','','','','','','',''),
                        $genisa->parametros('price',            'Precio',              'int',  '',   'notnull','','','','','','',''),

                    ],
                'relaciones'  =>
                    [
                        $genisa->foreign('module_id','id','memberships_modules','CASCADE','CASCADE',
                            'module', 'belongsToMany', 'MembershipModule::class', 'module_id','membership_id', 'MembershipModule'),
                        $genisa->foreign('module_id','id','users_modules','CASCADE','CASCADE',
                            'module', 'belongsToMany', 'UserModule::class', 'module_id','user_id', 'UserModule'),

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
