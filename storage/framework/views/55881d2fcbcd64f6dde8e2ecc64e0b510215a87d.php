<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/master.css')); ?>" rel="stylesheet">
</head>
<body>
    <div class="container-fluid" style="background-color:rgba(255,255,0,0.7)">
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
