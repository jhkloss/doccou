<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <title>Doccou</title>

    <link rel="stylesheet" href="{{ URL::asset('css/bulma.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('font-awesome/css/all.css') }}">

    <script src="{{ URL::asset('js/jquery.js') }}"></script>
    <script src="{{ URL::asset('js/main.js') }}"></script>

</head>
<body>
    @include('partials/header')

    <div class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </div>

    @if(!Auth::check())
        @include('partials/login')
    @endif

    @include('partials/footer')
</body>
</html>
