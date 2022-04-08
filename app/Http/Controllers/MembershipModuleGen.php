<?php

namespace App\Http\Controllers;

use stdClass;

class MembershipModuleGen extends Controller
{
    public function index()
    {
        $gen = new stdClass();
        $genisa = new MakeTemplateController();
        $tabla      =
            [
                'ZNOMBRESZ'   => 'MembershipsModules' ,
                'ZNOMBREZ'    => 'MembershipModule' ,
                'ZnombresZ'   => 'memberships_modules' ,
                'ZnombreZ'    => 'membership_module' ,
                'columnas'  =>
                    [
                        $genisa->parametros('membership_id',     'Miembro',            'int',  '',   'notnull','fk','',
                            'Membership','memberships','membership','descripcion',''),
                        $genisa->parametros('module_id',     'Modulo',            'int',  '',   'notnull','fk','',
                            'Module','modules','module','descripcion',''),

                        $genisa->parametros('subtotal',             'Subtotal',     'int',  '',   'notnull','','','','','','',''),
                        $genisa->parametros('total',                'Total',        'int',  '',   'notnull','','','','','','',''),
                        $genisa->parametros('discount',             'Descuento',    'int',  '',   'notnull','','','','','','',''),

                         $genisa->parametros('state',               'Estado',       'enum',  '',  'notnull','','','','','','','','states','MembershipState'),

                    ],

                'relaciones'  =>
                    [
                        $genisa->foreign('membership_id','id','memberships','CASCADE','CASCADE',
                            'membership', 'belongsTo', 'Membership::class', 'membership_id','', ''),
                        $genisa->foreign('module_id','id','modules','CASCADE','CASCADE',
                            'module', 'belongsTo', 'Module::class', 'module_id','', ''),

                    ],
                'enumCol'  =>
                    [
                        $genisa->enumCol('state',           'ACTIVO',         'Activo'  ),
                        $genisa->enumCol('state',           'INACTIVO',       'Inactivo'  ),

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

