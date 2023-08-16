<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>{{ $title ?? 'UNICO GLOBAL CAPITAL ADMIN' }}</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">

    @stack('style')
</head>

<body>
    @include('layout.partials.header')

    @yield('body')


    @include('layout.partials.footer')

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}"></script>
    @stack('script')
</body>

</html>
