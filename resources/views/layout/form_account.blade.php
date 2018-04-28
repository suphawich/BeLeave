<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <title>@yield('title')</title>
    @stack('style')
</head>
<body>
    @yield('form')
    @stack('script')
</body>
</html>
