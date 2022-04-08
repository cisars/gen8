{{'<?php'}}
{{--CONFIGURACION--}}
@php
    $NOMBRES  = $gen->tabla['ZNOMBRESZ'] ;
    $NOMBRE   = $gen->tabla['ZNOMBREZ'] ;
    $nombres  = $gen->tabla['ZnombresZ'] ;
    $nombre   = $gen->tabla['ZnombreZ'] ;
// GENISA Begin
@endphp
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

<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="container">

            <div class="page-header">
                <div class="page-title">
                    <h3>{{ $NOMBRE }}</h3>
                </div>
            </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-cyan">
                                <div class="card-header">
                                    {{'@'}}isset(${{ $nombre }}->id)
                                        <h3 class="card-title">Editar {{ $NOMBRE }}</h3>
                                    {{'@'}}isset($errors)
                                        {{'@'}}foreach ($errors->all() as $error)
                                    {{'{'}}{{'{'}}$error{{'}'}}{{'}'}}
                                        {{'@'}}endforeach
                                    {{'@'}}endisset
                                    {{'@'}}else
                                        <h3 class="card-title">Crear {{ $NOMBRES }}</h3>
                                    {{'@'}}endisset
                                </div>


                                <div class="card-body">
                                    {{'@'}}isset(${{ $nombre }}->id)
                                        {{'{'}}!! Form::model(${{ $nombre }}, ['route' => ['{{ $nombres }}.update', ${{ $nombre }}->id], 'method' => 'PATCH']) !!{{'}'}}
                                        <div class="form-group col">
                                            {{'{'}}!! Form::label('id', 'Código de {{ $NOMBRE }}') !!{{'}'}}
                                            {{'{'}}!! Form::text('id', old('id'), ['class' => 'form-control', 'readonly' ,'id' => 'id']) !!{{'}'}}

                                        </div>
                                    {{'@'}}else
                                        {{'{'}}!! Form::open(
                                            ['route' =>
                                                ['{{ $nombres }}.store' ],
                                                    'method'    => 'post',
                                                    'id'        => 'form',
                                                ]
                                        ) !!{{'}'}}
                                    {{'@'}}endisset

                                    {{'{'}}{{'{'}}--<div class="form-row">--{{'}'}}{{'}'}}

                                        {{'{'}}{{'{'}}--Set all function cons base model dropdown list char 1--{{'}'}}{{'}'}}



@foreach ($gen->tabla['columnas'] as $dataCol)
@if($dataCol['tipo'] == 'cons')
@foreach ($gen->tabla['constantes'] as $dataCon)
@if($dataCon['nombre'] == $dataCol['nombre'])
@if($aux != $dataCon['nombre'])
                                    {{'{'}}{{'{'}}--CONST {{ $dataCon['descripcion'] }} | {{$auxFix = $dataCon['nombre']}} | {{$aux = $dataCon['nombre']}} --{{'}'}}{{'}'}}
                                    <div class="form-group col">
                                        <label for="{{ $auxFix }}" >{{ $dataCon['nombres'] }}</label>
                                        <select
                                            class   ="form-control"
                                            name    ="{{ $auxFix }}"
                                            id      ="{{ $auxFix }}">
                                            {{'@'}}foreach (${{ $dataCon['nombres'] }} as $key => ${{ $auxFix }})
                                            <option value="{{'{'}}{{'{'}}   $key   {{'}'}}{{'}'}}"
                                                    {{'@'}}if (isset(${{ $gen->tabla['ZnombreZ'] }}->{{ $auxFix }}) == old('{{ $auxFix }}', $key) )
                                                selected="selected"
                                                {{'@'}}endif
                                                >{{'{'}}{{'{'}}  ${{ $auxFix }}   {{'}'}}{{'}'}} </option>
                                            {{'@'}}endforeach
                                        </select>
                                        {{'@'}}foreach ($errors->get('{{ $auxFix }}') as $error)
                                        <span class="text text-danger">{{'{'}}{{'{'}}   $error    {{'}'}}{{'}'}}</span>
                                        {{'@'}}endforeach
                                    </div>
                                    {{'{'}}{{'{'}}-- FIN CONST {{ $dataCon['visibilidad'] }}------------------------------------ --{{'}'}}{{'}'}}

@endif
@endif
@endforeach
@endif
@if($dataCol['tipo'] == 'enum')
                                    {{'{'}}{{'{'}}--ENUM {{ $dataCol['visibilidad'] }} | {{$auxFix = $dataCol['nombre']}} | {{$aux = $dataCol['nombre']}} --{{'}'}}{{'}'}}
                                    <div class="form-group col">
                                        <label for="{{ $auxFix }}" >{{ $dataCol['nombresEnum'] }}</label>
                                        <select
                                            class   ="form-control"
                                            name    ="{{ $auxFix }}"
                                            id      ="{{ $auxFix }}">
                                            {{'@'}}foreach (${{ $dataCol['nombresEnum'] }} as $key => ${{ $auxFix }})
                                            <option value="{{'{'}}{{'{'}}   $key   {{'}'}}{{'}'}}"
                                                    {{'@'}}if (isset(${{ $gen->tabla['ZnombreZ'] }}->{{ $auxFix }}) == old('{{ $auxFix }}', $key) )
                                                selected="selected"
                                                {{'@'}}endif
                                                >{{'{'}}{{'{'}}  ${{ $auxFix }}   {{'}'}}{{'}'}} </option>
                                            {{'@'}}endforeach
                                        </select>
                                        {{'@'}}foreach ($errors->get('{{ $auxFix }}') as $error)
                                        <span class="text text-danger">{{'{'}}{{'{'}}   $error    {{'}'}}{{'}'}}</span>
                                        {{'@'}}endforeach
                                    </div>
                                    {{'{'}}{{'{'}}-- FIN ENUM {{ $dataCol['visibilidad'] }}------------------------------------ --{{'}'}}{{'}'}}

@endif
@if ($dataCol['visibilidad'] == 'hidden')

@elseif ($dataCol['cardinalidad'] == 'fk' || $dataCol['cardinalidad'] == 'pkfk')
                                        <div class="form-group col">
                                            {{'{'}}{{'{'}}--SELECT FK {{ $dataCol['visibilidad'] }} --{{'}'}}{{'}'}}
                                            {{'{'}}!! Form::label('{{ $dataCol['nombre'] }}', '{{ $dataCol['visibilidad'] }}') !!{{'}'}}
                                            {{'{'}}!! Form::select('{{ $dataCol['nombre'] }}', ${{ $dataCol['fks'] }}->pluck('{{ $dataCol['orderby'] }}', 'id')  ,
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

@elseif ( ($dataCol['tipo'] == 'date' || $dataCol['tipo'] == 'timestamp')  && ($dataCol['cardinalidad'] != 'fk' && $dataCol['cardinalidad'] != 'cons'  && $dataCol['cardinalidad'] != 'pkfk'   ))
                                        <div class="form-group col">
                                            {{'{'}}{{'{'}}--DATE TIMESTAMP {{ $dataCol['visibilidad'] }} --{{'}'}}{{'}'}}

                                            <label for="{{ $dataCol['nombre'] }}">{{ $dataCol['visibilidad'] }} </label>
                                            <input class    = "form-control"
                                                   type     = "date"
                                                   name     = "{{ $dataCol['nombre'] }}"
                                                   id       = "{{ $dataCol['nombre'] }}"
                                                   value    = '{{'{'}}{{'{'}} old('{{ $dataCol['nombre'] }}',    date('Y-m-d', strtotime(${{ $nombre }}->{{ $dataCol['nombre'] }} ?? date('Y-m-d') ))  )   {{'}'}}{{'}'}}'
                                                   placeholder="Introduzca {{ $dataCol['visibilidad'] }}">
                                            {{'@'}}foreach ($errors->get('{{ $dataCol['nombre'] }}') as $error)
                                                <span class="text text-danger">{{'{'}}{{'{'}} $error {{'}'}}{{'}'}}</span>
                                            {{'@'}}endforeach
                                        </div> {{-- fin form-group col--}}
                                        {{'{'}}{{'{'}}--DATE TIMESTAMP {{ $dataCol['visibilidad'] }}------------------------------------ --{{'}'}}{{'}'}}

@elseif ( ($dataCol['tipo'] == 'time' )  && ($dataCol['cardinalidad'] != 'fk' && $dataCol['cardinalidad'] != 'cons'  && $dataCol['cardinalidad'] != 'pkfk'  ))
                                                <div class="form-group col">
                                                    {{'{'}}{{'{'}}--DATE TIMESTAMP {{ $dataCol['visibilidad'] }} --{{'}'}}{{'}'}}

                                                    <label for="{{ $dataCol['nombre'] }}">{{ $dataCol['visibilidad'] }} </label>
                                                    <input class    = "form-control"
                                                           type     = "time"
                                                           name     = "{{ $dataCol['nombre'] }}"
                                                           id       = "{{ $dataCol['nombre'] }}"
                                                           value    = '{{'{'}}{{'{'}} old('{{ $dataCol['nombre'] }} ' ,    ${{ $nombre }}->{{ $dataCol['nombre'] }} ?? ''  ) {{'}'}}{{'}'}}'
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
                                            {{'{'}}!! Form::text(
                                                '{{ $dataCol['nombre'] }}',
                                                old('{{ $dataCol['nombre'] }}') ,
                                                [
                                                    'maxlength'     => '{{ $dataCol['longitud'] }}',
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

@elseif (($dataCol['tipo'] == 'boolean'   )  && ($dataCol['cardinalidad'] != 'fk' && $dataCol['cardinalidad'] != 'cons'  && $dataCol['cardinalidad'] != 'pkfk' ))
                                                <div class="form-group col">
                                                    {{'{'}}{{'{'}}--INPUT Radio {{ $dataCol['visibilidad'] }} --{{'}'}}{{'}'}}
                                                    {{'{'}}!! Form::label('{{ $dataCol['nombre'] }}', '{{ $dataCol['visibilidad'] }}') !!{{'}'}}
                                                    {{'{'}}!! Form::radio('{{ $dataCol['nombre'] }}', 0, old('{{ $dataCol['nombre'] }}') , [ 'id' => '{{ $dataCol['nombre'] }}' ]) !!{{'}'}}
                                                    No
                                                    {{'{'}}!! Form::radio('{{ $dataCol['nombre'] }}', 1, old('{{ $dataCol['nombre'] }}') , [ 'id' => '{{ $dataCol['nombre'] }}' ]) !!{{'}'}}
                                                    Si
                                                    {{'@'}}error("{{ $dataCol['nombre'] }}")
                                                    <span class="text text-danger">{{'{'}}{{'{'}} $message {{'}'}}{{'}'}}</span>
                                                    {{'@'}}enderror
                                                </div> {{-- fin form-group col--}}

@endif
@endforeach

                                        {{'{'}}{{'{'}}--</div>--{{'}'}}{{'}'}}{{-- fin form-row--}}


                                    <div class="card-footer  ">
                                        <button
                                            type="submit"
                                            class="btn btn-info">Grabar</button>
                                        <a href="{{'{'}}{{'{'}} route('{{ $nombres }}.index') {{'}'}}{{'}'}}  " class="btn btn-secondary btn-close">Cancelar</a>
                                    </div>
                                    {{--  </form>--}}
                                    {{'{'}}!! Form::close() !!{{'}'}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
        </div>
    </div>
{{'@'}}endsection

{{'@'}}section('js')

    <script>
    </script>
{{'@'}}endsection

