@extends('adminlte::page')

@section('title', 'GEN')

@section('css' )
    <style>
        .CodeMirror {
            border: 1px solid #eee;
            height: auto;
            font-size: 12px
        }
    </style>
@stop

@section('menu-header')
    <li class="breadcrumb-item active">GEN</li>
@stop

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="row">

            {{-- INICIALIZAR--}}
            <div class="col-md-6">
                <div class="card card-outline card-danger">
                    <div class="card-header">
                        <h3 class="card-title"> Inicializar Modelo <b>{{$gen->tabla['ZNOMBREZ']}}</b></h3>
                    </div>
                    <div class="card-body   ">
                        <form role="form" id="form1" method="POST"
                              action="{{ route('maketemplatecontroller.inicializar', $gen->tabla['ZNOMBREZ']) }}">
                            <input name="capital" type="hidden" value="{{$gen->tabla['ZNOMBREZ']}}">
                            <input name="archivo" type="hidden" value="{{$gen->tabla['ZNOMBREZ']}}Controller.php">
                            <input name="minuscula" type="hidden" value="{{$gen->tabla['ZnombreZ']}}Controller.php">
                            @csrf
                            @method('POST')
                            <button type="submit"   class="btn btn-danger"> Procesar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-outline card-danger">
                    <div class="card-header">
                        <h3 class="card-title"> Sobreescribir todo <b>{{$gen->tabla['ZNOMBREZ']}}</b></h3>
                    </div>
                    <div class="card-body   ">
                        <form role="form" id="form2" method="POST"
                              action="{{ route('maketemplatecontroller.toFile', $gen->tabla['ZNOMBREZ']) }}">
                            <input name="capital" type="hidden" value="{{$gen->tabla['ZNOMBREZ']}}">
                            <input name="minuscula" type="hidden" value="{{$gen->tabla['ZnombreZ']}}">
                            @csrf
                            @method('POST')
                            <textarea name="codigocontroller" style="display: none"> @include('_template.controller',['gen'=>$gen]) </textarea>
                            <textarea name="codigomodel" style="display: none"> @include('_template.model',['gen'=>$gen]) </textarea>
                            <textarea name="codigoindex" style="display: none"> @include('_template.index',['gen'=>$gen]) </textarea>
                            <textarea name="codigoedit" style="display: none"> @include('_template.edit',['gen'=>$gen]) </textarea>
                            <textarea name="codigofake" style="display: none"> @include('_template.fake',['gen'=>$gen]) </textarea>
                            <textarea name="codigorequeststore" style="display: none"> @include('_template.store',['gen'=>$gen]) </textarea>
                            <textarea name="codigorequestupdate" style="display: none"> @include('_template.update',['gen'=>$gen]) </textarea>
                            <textarea name="codigomigration" style="display: none"> @include('_template.migration',['gen'=>$gen]) </textarea>
                            <button type="submit"   class="btn btn-danger"> Procesar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
            <div class="card card-outline card-info ">
                <div class="card-header">
                    <h3 class="card-title">
                        {{$gen->tabla['ZNOMBREZ']}}Controller.php
                    </h3>
                </div>
                <div class="card-body border-primary col-md-12" id="ControllerToCodeMirror">
                    {{--                        <a href="{{ route('feriadogen.alarchivo', $contenido) }}" > test</a>--}}
                    <textarea
                        id="Controller|CodeMirror"
                        class="col-md-12"
                        style="font-size: x-small">@include('_template.controller',['gen'=>$gen])</textarea>
                    <button
                        type="button"
                        class="btn btn-success pull-right"
                        onclick="copyText('Controller|CodeMirror');"> Copiar
                        <i class="fas fa-clipboard" aria-hidden="true"></i>
                        <form role="form" id="form3" method="POST"
                              action="{{ route('maketemplatecontroller.toFile', $gen->tabla['ZNOMBREZ']) }}">
                            <input name="capital" type="hidden" value="{{$gen->tabla['ZNOMBREZ']}}">
                            <input name="archivo" type="hidden" value="{{$gen->tabla['ZNOMBREZ']}}Controller.php">
                            <input name="minuscula" type="hidden" value="{{$gen->tabla['ZnombreZ']}}Controller.php">
                            <textarea name="elcodigo" style="display: none"> @include('_template.controller',['gen'=>$gen]) </textarea>
                            @csrf
                            @method('POST')
                            <button type="button" disabled class="btn "> Crear archivo</button>
                        </form>

                    </button>
                </div>
            </div>
        </div>

        {{-- Model|CodeMirror--}}
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        Models/{{$gen->tabla['ZNOMBREZ']}}.php
                    </h3>
                </div>
                <div class="card-body border-primary col-md-12">
                        <textarea
                            id="Model|CodeMirror"
                            class="col-md-12"
                            style="font-size: x-small">@include('_template.model',['gen'=>$gen])</textarea>
                    <button
                        type="button"
                        class="btn btn-success pull-right"
                        onclick="copyText('Model|CodeMirror');"> Copiar
                        <i class="fas fa-clipboard" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Index|CodeMirror--}}
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        Index/{{$gen->tabla['ZNOMBREZ']}}.php (View)
                    </h3>
                </div>
                <div class="card-body border-primary col-md-12">
                        <textarea
                            id="Index|CodeMirror"
                            class="col-md-12"
                            style="font-size: x-small">@include('_template.index',['gen'=>$gen])</textarea>
                    <button
                        type="button"
                        class="btn btn-success pull-right"
                        onclick="copyText('Index|CodeMirror');"> Copiar
                        <i class="fas fa-clipboard" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Edit|CodeMirror--}}
        <div class="col-md-12 ">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        Edit/{{$gen->tabla['ZNOMBREZ']}}.php (View)
                    </h3>
                </div>
                <div class="card-body border-primary col-md-12">
                        <textarea
                            id="Edit|CodeMirror"
                            class="col-md-12"
                            style="font-size: x-small"
                        >@include('_template.edit',['gen'=>$gen])</textarea>
                    <button
                        type="button"
                        class="btn btn-success pull-right"
                        onclick="copyText('Edit|CodeMirror');"> Copiar
                        <i class="fas fa-clipboard" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>


        {{-- Fake|CodeMirror--}}
        <div class="col-md-12 ">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        Fake/{{$gen->tabla['ZNOMBREZ']}}.php (Fake)
                    </h3>
                </div>
                <div class="card-body border-primary col-md-12">
                        <textarea
                            id="Fake|CodeMirror"
                            class="col-md-12"
                            style="font-size: x-small"
                        >@include('_template.fake',['gen'=>$gen])</textarea>
                    <button
                        type="button"
                        class="btn btn-success pull-right"
                        onclick="copyText('Fake|CodeMirror');"> Copiar
                        <i class="fas fa-clipboard" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
        (Request)
        {{-- Store|CodeMirror--}}
        <div class="col-md-12 ">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        Store/{{$gen->tabla['ZNOMBREZ']}}.php (Request)
                    </h3>
                </div>
                <div class="card-body border-primary col-md-12">
                        <textarea
                            id="Store|CodeMirror"
                            class="col-md-12"
                            style="font-size: x-small"
                        >@include('_template.store',['gen'=>$gen])</textarea>
                    <button
                        type="button"
                        class="btn btn-success pull-right"
                        onclick="copyText('Store|CodeMirror');"> Copiar
                        <i class="fas fa-clipboard" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
        {{-- Update|CodeMirror--}}
        <div class="col-md-12 ">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        Update/{{$gen->tabla['ZNOMBREZ']}}.php (Request)
                    </h3>
                </div>
                <div class="card-body border-primary col-md-12">
                        <textarea
                            id="Update|CodeMirror"
                            class="col-md-12"
                            style="font-size: x-small"
                        >@include('_template.update',['gen'=>$gen])</textarea>
                    <button
                        type="button"
                        class="btn btn-success pull-right"
                        onclick="copyText('Update|CodeMirror');"> Copiar
                        <i class="fas fa-clipboard" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
        {{-- Migration|CodeMirror--}}
        <div class="col-md-12 ">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        Migration/{{$gen->tabla['ZNOMBREZ']}}.php (MIGRATION)
                    </h3>
                </div>
                <div class="card-body border-primary col-md-12">
                        <textarea
                            id="Migration|CodeMirror"
                            class="col-md-12"
                            style="font-size: x-small"
                        >@include('_template.migration',['gen'=>$gen])</textarea>
                    <button
                        type="button"
                        class="btn btn-success pull-right"
                        onclick="copyText('Migration|CodeMirror');"> Copiar
                        <i class="fas fa-clipboard" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>

        </div>
        <!--   .col-->

        <div class="row">
            <div class="col-md-12">
                <div class="card card-cyan">
                    <div class="card-header">
                        <h3 class="card-title">GEN </h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">

                        </div>

                        <table class="table table-sm table-hover nowrap d-table">
                            <thead class="">
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            Agregar rutas
                            <tbody>
                            {{--                            @dd($reservas)--}}


                            <tr>
                                <td>{{ $gen->dat }}</td>
                            </tr>
                            <tr>
                                <td>En View/Vendor/adminlte/page.blade.php</td>

                                <td>Route::current()->getName() == 'nuevogen'</td>
                            </tr>
                            <tr>
                                <td>En web.php</td>

                                <td>Route::get('/nuevogen', 'NuevoGen@index')->name('nuevogen');</td>
                            </tr>
                            <tr>
                                <td>En adminlte.config.php</td>

                            </tr>

                            </tbody>
                        </table>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->


@endsection

@section('js')
    <script>

        $(function () {
            //  https://codemirror.net/demo/theme.html#dracula
            // Controller|CodeMirror
            CodeMirror.fromTextArea(document.getElementById("Controller|CodeMirror"), {
                theme: "material",
                readOnly: true,
                lineNumbers: true,
                matchBrackets: true,
                mode: "application/x-httpd-php",
                indentUnit: 4,
                indentWithTabs: true,
                smartIndent: true
            }).setSize(1200, 700);
            //.indentLine('smart')
            //.indentAutoShift
            //.setSize('100%','100%')
            ;
            CodeMirror.fromTextArea(document.getElementById("Model|CodeMirror"), {
                theme: "material",
                readOnly: true,
                lineNumbers: true,
                matchBrackets: true,
                mode: "application/x-httpd-php",
                indentUnit: 4,
                indentWithTabs: true,
                smartIndent: true
            }).setSize(1200, 700);

            CodeMirror.fromTextArea(document.getElementById("Index|CodeMirror"), {
                theme: "material",
                readOnly: true,
                lineNumbers: true,
                matchBrackets: true,
                mode: "application/x-httpd-php",
                indentUnit: 4,
                indentWithTabs: true,
                smartIndent: true
            }).setSize(1200, 700);

            CodeMirror.fromTextArea(document.getElementById("Edit|CodeMirror"), {
                theme: "material",
                readOnly: true,
                lineNumbers: true,
                matchBrackets: true,
                mode: "application/x-httpd-php",
                indentUnit: 4,
                indentWithTabs: true,
                smartIndent: true,

            }).setSize(1200, 700);

            CodeMirror.fromTextArea(document.getElementById("Fake|CodeMirror"), {
                theme: "material",
                readOnly: true,
                lineNumbers: true,
                matchBrackets: true,
                mode: "application/x-httpd-php",
                indentUnit: 4,
                indentWithTabs: true,
                smartIndent: true,

            }).setSize(1200, 700);

            CodeMirror.fromTextArea(document.getElementById("Store|CodeMirror"), {
                theme: "material",
                readOnly: true,
                lineNumbers: true,
                matchBrackets: true,
                mode: "application/x-httpd-php",
                indentUnit: 4,
                indentWithTabs: true,
                smartIndent: true,

            }).setSize(1200, 700);

            CodeMirror.fromTextArea(document.getElementById("Update|CodeMirror"), {
                theme: "material",
                readOnly: true,
                lineNumbers: true,
                matchBrackets: true,
                mode: "application/x-httpd-php",
                indentUnit: 4,
                indentWithTabs: true,
                smartIndent: true,

            }).setSize(1200, 700);
            CodeMirror.fromTextArea(document.getElementById("Migration|CodeMirror"), {
                theme: "material",
                readOnly: true,
                lineNumbers: true,
                matchBrackets: true,
                mode: "application/x-httpd-php",
                indentUnit: 4,
                indentWithTabs: true,
                smartIndent: true,

            }).setSize(1200, 700);
        });

        function CopyToClipboard(objetoid) {

            $("#" + objetoid).select();
            document.execCommand('copy');

        }


        function copyText() {
            var text = document.querySelectorAll('#' + containerid + ' .CodeMirror-code')
            console.log(text);
        }


        //http://jsfiddle.net/MrPolywhirl/3phdkg66/
        function copyText4(target) {
            var _target = target;
            if (typeof _target === 'string') {
                _target = document.querySelector(_target);
            }
            if (_target === null || !_target.tagName === undefined) {
                throw new Error('Element does not reference a CodeMirror instance.');
            }

            if (_target.className.indexOf('CodeMirror') > -1) {
                return _target.CodeMirror;
            }

            if (_target.tagName === 'TEXTAREA') {
                return _target.nextSibling.CodeMirror;
            }

            return null;
        };

        function copyText3(containerid) {
            //alert(document.body.createTextRange().moveToElementText($("#"+containerid+ ' > .CodeMirror-code').select()) );
            console.log(document.querySelectorAll('#' + containerid + ' .CodeMirror-code'));
            console.log(document.querySelectorAll('#' + containerid + ' .CodeMirror-code'));
            //    console.log(document.querySelectorAll('#'+containerid +' .CodeMirror-code').value);

            var doc = document.getElementById(containerid);
            var notes = null;
            // for (var i = 0; i < doc.childNodes.length; i++) {
            for (var i = 0; i < document.querySelectorAll('#' + containerid + ' .CodeMirror-code').length; i++) {
                //   console.log(doc.childNodes[i].className);
                // if (doc.childNodes[i].className == "CodeMirror-code") {
                if (document.querySelectorAll('#' + containerid + ' .CodeMirror-code')[i].className == "CodeMirror-code") {
                    notes = document.querySelectorAll('#' + containerid + ' .CodeMirror-code')[i];
                    console.log(document.querySelectorAll('#' + containerid + ' .CodeMirror-code')[i]);
                    break;
                }
            }

            var range = document.createRange();
            window.getSelection();
            // range.selectNode(notes);
            // window.getSelection().removeAllRanges(); // clear current selection
            // window.getSelection().addRange(range); // to select text
            document.execCommand("copy");
            // window.getSelection().removeAllRanges();// to deselect


        }
    </script>


@endsection
