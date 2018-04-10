<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    @stack('style')
</head>
<body>
    <div class="container-fluid nav">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-8">
                    <img src="/images/logo.png" class="logo" alt="logo website">
                </div>
                <div class="col-md-9 d-none d-sm-none d-md-block">
                    <div class="row float-right topnav">
                        {{-- <ul class="list-inline">
                            <li class="list-inline-item"><a href="#">Menu1</a></li>
                            <li class="list-inline-item"><a href="#">Menu2</a></li>
                            <li class="list-inline-item"><a href="#">Menu3</a></li>
                            <li class="list-inline-item"><a href="#">Menu4</a></li>
                            <li class="list-inline-item"><button class="btn btn-danger btn-sm" name="trail-btn">Free trail</button></li>
                        </ul> --}}
                        <a href="#"><span><i class="fa fa-sign-out"></i></span><span> Log Out</span></a>
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
    </div>
    <div id="dashboard-content" class="container-fluid">
        <div class="sidebar sidebar-default" v-bind:class="{'sidebar-toggled': isShowMenuIcon}">
            <a href="#" class="sidebar-item sidebar-item-hover-default" v-if="isShowMenuList" v-on:click="lessMoreMenu">
                <span class="leftArrowIcon menuIcon"><i class="fa fa-chevron-left"></i></span>
                <span class="arrowText"></span>
            </a>
            <a href="#" class="sidebar-item sidebar-item-hover-default" v-if="isShowMenuIcon" v-on:click="lessMoreMenu">
                <span class="rightArrowIcon menuIcon"><i class="fa fa-chevron-right"></i></span>
                <span class="arrowText"></span>
            </a>
            <a href="#" class="sidebar-item sidebar-item-hover-default">
                <span class="menuIcon"><i class="fa fa-home"></i></span>
                <span class="menuText" v-if="isShowMenuList"> Home</span>
            </a>
        </div>
        <div style="margin-left:300px;">
            <div class="w3-container content">
            <h2>Hello</h2>
            <p>In this example, we have added a dropdown menu inside the sidebar.</p>
            <p>Notice the caret-down icon, which we use to indicate that this is a dropdown menu.</p>
            </div>
        </div>
    </div>
    @stack('script')
</body>
</html>
