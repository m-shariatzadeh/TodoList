<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')
    <title>@yield('title')</title>
</head>
<body>

    @yield('content')

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/socket.io.min.js') }}" ></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    @yield('script')
</body>
</html>
