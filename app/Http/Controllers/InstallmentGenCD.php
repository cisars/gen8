<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class InstallmentGenCD extends Controller
{
    public function index()
    {
        // TYPE: ABM, CD, PIVOT, POLI
        // TYPE: abm, cd, pivot, poli
        $gen = new stdClass();
        $controllerHead = new InstallmentGen();
        //dd($controllerHead->index('x'));
        $controllerDetail = new DetailInstallmentGen('x');
        $genisa = new MakeTemplateController();
        $tabla      =
            [
                'ZTYPEZ'   => 'cd' ,
                'ZcontrollerHeadZ'   => 'InstallmentGen' ,
                'ZcontrollerDetailZ'   => 'DetailInstallmentGen' ,
            ];
        dd($genisa->index($tabla));
        $gen->dat = '001';
        $gen->tabla = $tabla;
        return view('_template.cd.matrix', compact('gen')); // Lista con BelongsTo
    }
}
