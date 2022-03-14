{{'<?php'}}
{{--CONFIGURACION--}}
// $NOMBRES  = $gen->tabla['ZNOMBRESZ'] {{ $NOMBRES  = $gen->tabla['ZNOMBRESZ']}}
// $NOMBRE   = $gen->tabla['ZNOMBREZ'] {{ $NOMBRE   = $gen->tabla['ZNOMBREZ']}}
// $nombres  = $gen->tabla['ZnombresZ'] {{ $nombres  = $gen->tabla['ZnombresZ']}}
// $nombre   = $gen->tabla['ZnombreZ'] {{ $nombre   = $gen->tabla['ZnombreZ']}}
// {{$aux = null}}
// {{$coma = ','}}
// GENISA Begin
?>
{{'@'}}extends('adminlte::page')
{{'@'}}section('title', '{{ $NOMBRES }}')
{{'@'}}section('css')
{{'@'}}stop

{{'@'}}section('menu-header')
<li class="breadcrumb-item"><a href="/{{'{'}}{{'{'}}  Request::segment(1) {{'}'}}{{'}'}} "> {{'{'}}{{'{'}} Request::segment(1) {{'}'}}{{'}'}}</a></li>
<li class="breadcrumb-item active"> Editar {{ $NOMBRES }} </li>
{{'@'}}stop
{{'@'}}section('content')

    <div class="row">
        <div class="col-lg-12">

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-cyan">
                                <div class="card-header">
                                    {{'@'}}isset(${{ $nombre }}->id)
                                        <h3 class="card-title">Editar {{ $NOMBRE }}</h3>
                                    {{'@'}}else
                                        <h3 class="card-title">Crear {{ $NOMBRES }}</h3>
                                    {{'@'}}endisset
                                </div>


                                <div class="card-body">
                                    {{'@'}}isset(${{ $nombre }}->id)
                                        {{'{'}}!! Form::model(${{ $nombre }}, ['route' => ['{{ $nombre }}.update', ${{ $nombre }}->id], 'method' => 'PATCH']) !!{{'}'}}
                                        <div class="form-group col">
                                            {{'{'}}!! Form::label('id', 'Código de {{ $NOMBRE }}') !!{{'}'}}
                                            {{'{'}}!! Form::text('id', old('id'), ['class' => 'form-control', 'readonly' ,'id' => 'id']) !!{{'}'}}

                                        </div>
                                    {{'@'}}else
                                        {{'{'}}!! Form::open(
                                            ['route' =>
                                                ['{{ $nombre }}.store' ],
                                                    'method'    => 'post',
                                                    'id'        => 'form',
                                                ]
                                        ) !!{{'}'}}
                                    {{'@'}}endisset

                                    {{'{'}}{{'{'}}--<div class="form-row">--{{'}'}}{{'}'}}

                                        {{'{'}}{{'{'}}--Set all function cons base model dropdown list char 1--{{'}'}}{{'}'}}

@foreach ($gen->tabla['constantes'] as $dataCol)
@if($aux != $dataCol['nombre'])
                                        <div class="form-group col">
                                            {{'{'}}{{'{'}}--CONST {{ $dataCol['visibilidad'] }} - {{$auxFix = $dataCol['nombre']}} --{{'}'}}{{'}'}}
                                            {{'{'}}!! Form::label('{{ $dataCol['nombre'] }}', '{{ $dataCol['visibilidad'] }}') !!{{'}'}} {{'{'}}{{'{'}}--{{$aux = $dataCol['nombre']}}--{{'}'}}{{'}'}}
                                            {{'{'}}!! Form::select('{{ $dataCol['nombre'] }}',
                                                [
                                                    '0'                             => 'Seleccione {{ $dataCol['visibilidad'] }}'  ,
@foreach ($gen->tabla['constantes'] as $key => $dataCol)
@if ($key === array_key_last($gen->tabla['constantes']))
                                                    {{'{'}}{{'{'}}-- {{ $coma = ''}} --{{'}'}}{{'}'}}
@endif
@if($aux == $dataCol['nombre'])
                                                    ${{ $dataCol['nombres'] }}['{{ $dataCol['descripcion'] }}']           => '{{ $dataCol['descripcion'] }}' {{ $coma }}
@endif
@endforeach
                                                ],
                                                old('{{ $auxFix }}') ,
                                                ['class' => 'form-control']
                                            ) !!{{'}'}}
                                            {{'@'}}error("{{ $auxFix }}")
                                                <span class="text text-danger">{{'{'}}{{'{'}} $message {{'}'}}{{'}'}}</span>
                                            {{'@'}}enderror
                                        </div> {{-- fin form-group col--}}
                                            {{'{'}}{{'{'}}--CONST ------------------------------------ --{{'}'}}{{'}'}}

@endif
@endforeach

@foreach ($gen->tabla['columnas'] as $dataCol)
@if ($dataCol['visibilidad'] == 'hidden')

@elseif ($dataCol['cardinalidad'] == 'fk'  || $dataCol['cardinalidad'] == 'pkfk')
                                        <div class="form-group col">
                                            {{'{'}}{{'{'}}--SELECT FK {{ $dataCol['visibilidad'] }} --{{'}'}}{{'}'}}
                                            {{'{'}}!! Form::label('{{ $dataCol['nombre'] }}', '{{ $dataCol['visibilidad'] }}') !!{{'}'}}
                                            {{'{'}}!! Form::select('{{ $dataCol['nombre'] }}', ${{ $dataCol['fks'] }}->pluck('{{ $dataCol['selectdesc'] }}', 'id')  ,
                                                old('{{ $dataCol['nombre'] }}') ,
                                                [
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Seleccione {{ $dataCol['visibilidad'] }}']
                                            ) !!{{'}'}}
                                            {{'@'}}error("{{ $dataCol['nombre'] }}")
                                                <span class="text text-danger">{{'{'}}{{'{'}} $message {{'}'}}{{'}'}}</span>
                                            {{'@'}}enderror
                                        </div> {{-- fin form-group col--}}
                                            {{'{'}}{{'{'}}--SELECT FK {{ $dataCol['visibilidad'] }} ------------------------------------ --{{'}'}}{{'}'}}

@elseif ( ($dataCol['tipo'] == 'date' || $dataCol['tipo'] == 'timestamp')  && ($dataCol['cardinalidad'] != 'fk' && $dataCol['cardinalidad'] != 'cons'  && $dataCol['cardinalidad'] != 'pkfk'  ))
                                        <div class="form-group col">
                                            {{'{'}}{{'{'}}--DATE TIMESTAMP {{ $dataCol['visibilidad'] }} --{{'}'}}{{'}'}}
                                            {{'@'}}if (isset(${{ $nombre }}->id))
                                                {{'{'}}{{'{'}} $retrieveDate =  date('Y-m-d', strtotime(${{ $nombre }}->{{ $dataCol['nombre'] }} ))  {{'}'}}{{'}'}}
                                            {{'@'}}else
                                                {{'{'}}{{'{'}} $retrieveDate = null  {{'}'}}{{'}'}}
                                            {{'@'}}endif
                                            <label for="{{ $dataCol['nombre'] }}">{{ $dataCol['visibilidad'] }} </label>
                                            <input class    = "form-control"
                                                   type     = "date"
                                                   name     = "{{ $dataCol['nombre'] }}"
                                                   id       = "{{ $dataCol['nombre'] }}"
                                                   value    = '{{'{'}}{{'{'}} old('{{ $dataCol['nombre'] }}', $retrieveDate )   {{'}'}}{{'}'}}'
                                                   placeholder="Introduzca {{ $dataCol['visibilidad'] }}">
                                            {{'@'}}foreach ($errors->get('{{ $dataCol['nombre'] }}') as $error)
                                                <span class="text text-danger">{{'{'}}{{'{'}} $error {{'}'}}{{'}'}}</span>
                                            {{'@'}}endforeach
                                        </div> {{-- fin form-group col--}}
                                        {{'{'}}{{'{'}}--DATE TIMESTAMP {{ $dataCol['visibilidad'] }}------------------------------------ --{{'}'}}{{'}'}}


@elseif (($dataCol['tipo'] == 'int' || $dataCol['tipo'] == 'numeric' || $dataCol['tipo'] == 'smallint' || $dataCol['tipo'] == 'tinyint' )  && ($dataCol['cardinalidad'] != 'fk' && $dataCol['cardinalidad'] != 'cons'  && $dataCol['cardinalidad'] != 'pkfk'  ))
                                        <div class="form-group col">
                                            {{'{'}}{{'{'}}--INPUT NUMERIC {{ $dataCol['visibilidad'] }} --{{'}'}}{{'}'}}
                                            {{'{'}}!! Form::label('{{ $dataCol['nombre'] }}', '{{ $dataCol['visibilidad'] }}') !!{{'}'}}
                                            {{'{'}}!! Form::select('{{ $dataCol['nombre'] }}', ${{ $dataCol['fks'] }}->pluck('{{ $dataCol['selectdesc'] }}', 'id')  ,
                                            old('{{ $dataCol['nombre'] }}') ,
                                            [
                                                'type'          => 'numeric',
                                                'class'         => 'form-control',
                                                'placeholder'   => '{{ $dataCol['visibilidad'] }}'
                                            ]) !!{{'}'}}
                                            {{'@'}}error("{{ $dataCol['nombre'] }}")
                                                <span class="text text-danger">{{'{'}}{{'{'}} $message {{'}'}}{{'}'}}</span>
                                            {{'@'}}enderror
                                        </div> {{-- fin form-group col--}}
                                            {{'{'}}{{'{'}}--INPUT NUMERIC {{ $dataCol['visibilidad'] }} ------------------------------------ --{{'}'}}{{'}'}}

@elseif (($dataCol['tipo'] == 'char' || $dataCol['tipo'] == 'varchar' || $dataCol['tipo'] == 'text' )  && ($dataCol['cardinalidad'] != 'fk' && $dataCol['cardinalidad'] != 'cons'  && $dataCol['cardinalidad'] != 'pkfk' ))
                                        <div class="form-group col">
                                            {{'{'}}{{'{'}}--INPUT TEXT {{ $dataCol['visibilidad'] }} --{{'}'}}{{'}'}}
                                            {{'{'}}!! Form::label('{{ $dataCol['nombre'] }}', '{{ $dataCol['visibilidad'] }}') !!{{'}'}}
                                            {{'{'}}!! Form::text(
                                                '{{ $dataCol['nombre'] }}',
                                                old('{{ $dataCol['nombre'] }}') ,
                                                [
                                                    'maxlength'     => '{{ $dataCol['longitud'] }}',
                                                    'type'          => 'text',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => '{{ $dataCol['visibilidad'] }}'
                                                ]) !!{{'}'}}
                                            {{'@'}}error("{{ $dataCol['nombre'] }}")
                                                <span class="text text-danger">{{'{'}}{{'{'}} $message {{'}'}}{{'}'}}</span>
                                            {{'@'}}enderror
                                        </div> {{-- fin form-group col--}}
                                        {{'{'}}{{'{'}}--INPUT TEXT {{ $dataCol['visibilidad'] }} ------------------------------------ --{{'}'}}{{'}'}}

@endif
@endforeach

                                        {{'{'}}{{'{'}}--</div>--{{'}'}}{{'}'}}{{-- fin form-row--}}


                                    <div class="card-footer  ">
                                        <button
                                            type="submit"
                                            class="btn btn-info">Grabar</button>
                                        <a href="{{'{'}}{{'{'}} route('{{ $nombre }}.index') {{'}'}}{{'}'}}  " class="btn btn-secondary btn-close">Cancelar</a>
                                    </div>
                                    {{--  </form>--}}
                                    {{'{'}}!! Form::close() !!{{'}'}}
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>
{{'@'}}endsection

{{'@'}}section('js')

    <script>
    </script>
{{'@'}}endsection

