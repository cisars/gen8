{{'<?php'}}
{{--CONFIGURACION--}}
@php
    $NOMBRES  = $gen->tabla['ZNOMBRESZ'] ;
    $NOMBRE   = $gen->tabla['ZNOMBREZ'] ;
    $nombres  = $gen->tabla['ZnombresZ'] ;
    $nombre   = $gen->tabla['ZnombreZ'] ;
// GENISA Begin
@endphp
?>
{{'@'}}extends('adminlte::page')
{{'@'}}section('title', 'Listado de {{ $NOMBRES }}')
{{'@'}}section('css')
{{'@'}}stop

{{'@'}}section('menu-header')
    <li class="breadcrumb-item active">ABM {{ $NOMBRES }} </li>
{{'@'}}stop

{{'@'}}section('content')

{{'@'}}if( !empty(session('msg')))
    {{'@'}}include('adminlte::partials.modals.alerts',['msg'=>session('msg'), 'type'=>session('type') ])
{{'@'}}endif


<!-- Main content -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="page-header">
            <div class="page-title">
                <h3 class="card-title">{{ $NOMBRES }}</h3>
            </div>
        </div>

        <div class="row layout-top-spacing" id="miembros-row">
            <!-- /.Miembro -->
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <a  href="{{'{'}}{{'{'}}route('{{ $nombres }}.create'){{'}'}}{{'}'}}" class="btn bg-cyan">Nuevo {{ $NOMBRE }}</a>
                        </div>

                        <table class="table table-sm table-hover nowrap d-table" id="lista">
                            <thead class="">
                                <tr>
@foreach ($gen->tabla['columnas'] as $dataCol)
                                    <th class="">{{$dataCol['visibilidad'] === 'hidden' ? 'Id' : $dataCol['visibilidad']}} </th>
@endforeach
                                    <th class="">Acciones </th>
                                </tr>
                            </thead>
                            <tbody>
                            {{'@'}}foreach(${{ $nombres }} as $key => ${{ $nombre }})
                                <tr class="">
@foreach ($gen->tabla['columnas'] as $dataCol)
@php $muletaenum  = '' ; @endphp
@if ($dataCol['tipo'] == 'enum' )
@php $muletaenum  = '->name' ; @endphp
@endif
@if ($dataCol['cardinalidad'] == 'fk'  || $dataCol['cardinalidad'] == 'pkfk')
                                    <td>{{'{'}}{{'{'}} {{'$'}}{{ $nombre }}->{{ $dataCol['fk'] }}->{{ $dataCol['orderby'] }}      {{'}'}}{{'}'}}</td>
@else
                                    <td>{{'{'}}{{'{'}} {{'$'}}{{ $nombre }}->{{ $dataCol['nombre'] }}{{ $muletaenum }}      {{'}'}}{{'}'}}</td>
@endif
@endforeach
                                    <td class="">
                                        <a
                                            href="{{'{'}}{{'{'}} route('{{ $nombres }}.edit', ${{ $nombre }}->id) {{'}'}}{{'}'}}"
                                            class= "btn btn-info">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        {{'{'}}!! Form::open(
                                            ['route' =>
                                                ['{{ $nombres }}.destroy' ,  ${{ $nombre }}->id],
                                                    'method'    => 'DELETE',
                                                    'onsubmit'  => 'return confirm("¿Estas Seguro?")',
                                                    'id'        => 'form',
                                            ]
                                        ) !!{{'}'}}
                                        <button
                                            type        ="submit"
                                            class       ="btn btn-danger"
                                        >
                                            <i class ="fas fa-trash-alt" aria-hidden="true"></i>
                                        </button>
                                        {{'{'}}!! Form::close() !!{{'}'}}
                                        {{'</td>'}}
                                    {{'</tr>'}}
                                {{'@'}}endforeach
                            {{'</tbody>'}}
                        {{'</table>'}}
                    <!-- /.card-body -->
                    {{'</div>'}}
                <!-- /.card -->
                {{'</div>'}}
            <!-- /.col -->
            {{'</div>'}}
        {{'</div>'}}

    <!-- /.row -->
    {{'</div>'}}
    {{'</div>'}}
    <!-- /.content -->

{{'@'}}endsection

{{'@'}}section('js')
    <script>
        // $('#modal-success').modal();
        // $("#modals-alerts").fadeTo(1500, 500).slideUp(500, function(){
        //     $("#modals-alerts").slideUp(500);
        // });
    </script>


{{'@'}}endsection
