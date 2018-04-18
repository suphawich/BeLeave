<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <style>
        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            right: 0;
            background-color: white;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .close {
            position: absolute;
            top: 18px;
            left: 10px;
            border: 2px solid green !important;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #fff;
            font-size: 24px;
            -webkit-transition: all 0.2s ease; */
            -moz-transition: all 0.2s ease;
            -o-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        .close:hover, .close:focus {
            color: red;
            border: 2px solid red !important;
            text-decoration: none;
            cursor: pointer;
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
            filter: alpha(opacity=50);
            opacity: .5;
        }

        @media  screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }

        .side-nav-toggle {
            width: 28px;
            height: 28px;
            text-align: center;
            line-height: 28px;
            cursor: pointer;
            background-color: transparent;
        }

        span.icon:before {
            font-family: FontAwesome;
            content: "\f015";
        }
    </style>
</head>
<body>
    <div class="container-fluid" style="background-color:rgba(255,255,255,0.7)">
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-8">
                        Header
                    </div>
                    <div class="col-md-9 d-none d-sm-none d-md-block">
                        <div class="row float-right">
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="#">Menu1</a></li>
                                <li class="list-inline-item"><a href="#">Menu2</a></li>
                                <li class="list-inline-item"><a href="#">Menu3</a></li>
                                <li class="list-inline-item"><a href="#">Menu4</a></li>
                                <li class="list-inline-item"><button class="btn btn-danger btn-sm" name="trail-btn">Free trail</button></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-4 d-block d-sm-block d-md-none">
                        <span class="float-right" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
                    </div>
                </div>
            </div>
            <div id="mySidenav" class="sidenav">
                <button type="button" class="close" onclick="closeNav()"><span>×</span></button>
                <a href="#">Menu1</a>
                <a href="#">Menu2</a>
                <a href="#">Menu3</a>
                <a href="#">Menu4</a>
                <a class="btn btn-danger btn-sm" name="trail-btn" style="margin-left: 15px; margin-right: 15px;">Free trail</a>
            </div>
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
