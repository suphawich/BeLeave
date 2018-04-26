<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <title>@yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/master.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container-fluid" style="background-color:rgba(255,255,0,0.7)">
        <header>
        <div class="row float-right">
            <ul class="list-inline">
            <br>
                <li class="list-inline-item"><button class="btn btn-success btn-sm"><a href="#">Login</a></button></li>
                <li class="list-inline-item"><button class="btn btn-danger btn-sm" name="trail-btn">Register</button></li>
            </ul>
        </div>
            <!-- <div class="container">
                <div class="row">
                    <div class="col-md-3 col-8">
                        <img src="/images/logo.png" class="logo" alt="logo website">
                    </div>
                    <div class="col-md-9 d-none d-sm-none d-md-block">
                        <div class="row float-right">
                            <ul class="list-inline">
                                <li class="list-inline-item"><button class="btn btn-success btn-sm"><a href="#">Login</a></button></li>
                                <li class="list-inline-item"><button class="btn btn-danger btn-sm" name="trail-btn">Register</button></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-4 d-block d-sm-block d-md-none">
                        <span class="float-right" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
                    </div>
                </div>
            </div> -->
        </header>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="/js/app.js" charset="utf-8"></script>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "300px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
</body>
</html>
