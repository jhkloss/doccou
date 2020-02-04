<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Doccou</title>

    <link rel="stylesheet" href="{{ URL::asset('css/bulma.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('font-awesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/Chart.css') }}">

    <script src="{{ URL::asset('js/jquery.js') }}"></script>
    <script src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::asset('js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('js/main.js') }}"></script>

    @yield('scripts')

</head>
<body>

<div class="tile is-ancestor is-horizontal">

    <div class="tile is-parent is-3">
            @include('partials/menu')
    </div>

    <div class="tile is-parent is-8">
            <div class="main-content">
                <div class="container">
                    @yield('content')
                </div>
            </div>
    </div>

</div>


@if(!Auth::check())
    @include('partials/login')
@endif

@section('message')
    <div id="message-container" style="display: none">

    </div>
@show

@include('partials/footer')
</body>
</html>
