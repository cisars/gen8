<?php

namespace App\Http\Controllers;

use stdClass;

class UserModuleGen extends Controller
{
    public function index()
    {

        $gen = new stdClass();
        $genisa = new MakeTemplateController();
        $tabla      =
            [
                'ZNOMBRESZ'   => 'UsersModules' ,
                'ZNOMBREZ'    => 'UserModule' ,
                'ZnombresZ'   => 'users_modules' ,
                'ZnombreZ'    => 'user_module' ,
                'columnas'  =>
                    [
                        $genisa->parametros('user_id',     'Usuario',            'int',  '',   'notnull','fk','',
                            'User','users','user','descripcion',''),
                        $genisa->parametros('module_id',     'Modulo',            'int',  '',   'notnull','fk','',
                            'Module','modules','module','descripcion',''),
                        $genisa->parametros('membership_id',     'Membresia',            'int',  '',   'notnull','fk','',
                            'Membership','memberships','membership','descripcion',''),

                    ],
                'relaciones'  =>
                    [
                        $genisa->foreign('user_id','id','users','CASCADE','CASCADE',
                            'user', 'belongsTo', 'User::class', 'user_id','', ''),
                        $genisa->foreign('module_id','id','modules','CASCADE','CASCADE',
                            'module', 'belongsTo', 'Module::class', 'module_id','', ''),
                        $genisa->foreign('membership_id','id','memberships','CASCADE','CASCADE',
                            'membership', 'belongsTo', 'Membership::class', 'membership_id','', ''),


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

