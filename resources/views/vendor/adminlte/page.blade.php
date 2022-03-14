@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">

        {{-- Top Navbar --}}
        @if($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        @if(!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif

        {{-- Content Wrapper --}}
        @empty($iFrameEnabled)
            @include('adminlte::partials.cwrapper.cwrapper-default')
        @else
            @include('adminlte::partials.cwrapper.cwrapper-iframe')
        @endempty

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif

        {{-- Right Control Sidebar --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')

    @if(Route::current()->getName() == 'flot')
        {{--        <script src="{{ asset('plugins/chart.js/plot.js') }}" defer></script>--}}
        {{--        <script src="{{ asset('js/scriptFlot.js') }}" defer></script>--}}
    @endif
    @if(Route::current()->getName() == 'chartjs')
        {{--        <script src="{{ asset('js/scriptChart.js') }}" defer></script>--}}
    @endif
    @if(Route::current()->getName() == 'inline')
        {{--        <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}" defer></script>--}}
        {{--        <script src="{{ asset('plugins/sparkline/sparkline.js') }}" defer></script>--}}
        {{--        <script src="{{ asset('js/scriptInline.js') }}" defer></script>--}}
    @endif

    @if (Route::current()->getName() == 'data')
        {{--        <script src="{{ asset('js/scriptData.js') }}" defer></script>--}}
    @endif

    @if(
    Route::current()->getName() == 'maketemplate' ||
    Route::current()->getName() == 'facturagen' ||
    Route::current()->getName() == 'factura_detallegen' ||
    Route::current()->getName() == 'entregagen' ||
    Route::current()->getName() == 'membershipgen' ||
    Route::current()->getName() == 'modulegen' ||
    Route::current()->getName() == 'user_modulegen' ||
    Route::current()->getName() == 'membership_modulegen' ||
    Route::current()->getName() == 'companygen'
)
        <link href="{{ asset('/codemirror/lib/codemirror.css') }}"       rel="stylesheet">
        <link href="{{ asset('/codemirror/theme/monokai.css') }}"        rel="stylesheet">
        <link href="{{ asset('/codemirror/theme/material.css') }}"       rel="stylesheet">
        <script src="{{ asset('/codemirror/lib/codemirror.js') }}"       ></script>

        <script src="{{ asset('/codemirror/mode/htmlmixed/htmlmixed.js') }}"     ></script>
        <script src="{{ asset('/codemirror/addon/edit/matchbrackets.js') }}"     ></script>
        <script src="{{ asset('/codemirror/mode/htmlmixed/htmlmixed.js') }}"     ></script>
        <script src="{{ asset('/codemirror/mode/xml/xml.js') }}"                ></script>
        <script src="{{ asset('/codemirror/mode/javascript/javascript.js') }}"  ></script>
        <script src="{{ asset('/codemirror/mode/css/css.js') }}"            ></script>
        <script src="{{ asset('/codemirror/mode/clike/clike.js') }}"        ></script>
        <script src="{{ asset('/codemirror/mode/php/php.js') }}"            ></script>

    @endif

@stop
