<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <title>@yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    <form method="post">
        <div class="container">
            <div class="form-content">
                <div class="form-group text-center">
                    @yield('logo')
                </div>
                <div class="input-group">
                    @yield('user')
                </div>
            </div>
        </div>
    </form>
</body>
</html>
