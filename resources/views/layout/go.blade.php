<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body>
    <div id="dashboard">
        <div class="container-fluid navSecondary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-xl-3 d-none d-sm-block logo-content">
                        <img src="/images/logo.png" class="logo" alt="logo website">
                    </div>
                    <div class="col"></div>
                    <div class="col-1 d-block d-sm-block d-md-block d-lg-none">
                        <span class="float-right" style="font-size:30px; cursor:pointer" v-on:click="toggleOverlay">&#9776;</span>
                    </div>
                </div>
            </div>
            <div class="overlay overlay-default" v-bind:class="{'overlay-toggled': isOverlayToggled}">
                <div class="overlay-content">
                    <a href="#" class="sidebar-item sidebar-item-hover-default">About</a>
                    <a href="#" class="sidebar-item sidebar-item-hover-default">Services</a>
                    <a href="#" class="sidebar-item sidebar-item-hover-default">Clients</a>
                    <a href="#" class="sidebar-item sidebar-item-hover-default">Contact</a>
                </div>
            </div>
        </div>
        <div class="container-fluid nav">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-xl-3 logo-content">
                        <img src="/images/logo.png" class="logo" alt="logo website">
                    </div>
                    <div class="col"></div>
                    <div class="col-lg-5 col-xl-4 d-none d-sm-none d-md-none d-lg-block">
                        <div class="row float-right topnav">
                            <a href="#"><span><i class="fa fa-bell"></i></span><span class="badge badge-pill badge-dark">2</span> </a>
                            <a href="#" class="username"><span><i class="fa fa-user"></i></span><span>{{ session()->get('full_name') }}</span></a>
                            <a href="logout"><span><i class="fa fa-sign-out"></i></span><span> Log Out</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="sidebar sidebar-default" v-bind:class="{'sidebar-toggled': isShowMenuIcon}">
                <a href="#" class="sidebar-item sidebar-item-hover-default" v-if="isShowMenuList" v-on:click="lessMoreMenu">
                    <span class="leftArrowIcon menuIcon-nomargin"><i class="fa fa-chevron-left"></i></span>
                    <span class="arrowText"></span>
                </a>
                <a href="#" class="sidebar-item sidebar-item-hover-default" v-if="isShowMenuIcon" v-on:click="lessMoreMenu">
                    <span class="rightArrowIcon menuIcon"><i class="fa fa-chevron-right"></i></span>
                    <span class="arrowText"></span>
                </a>
                <a href="#" class="sidebar-item sidebar-item-hover-default" v-bind:class="{'sidebar-item-toggled': isShowMenuIcon, 'sidebar-item-toggled-hover': isHoverSubMenuHome}" @mouseover="hoverMenuHome" @mouseout="closeMenuHome">
                    <span class="menuIcon"><i class="fa fa-home"></i></span>
                    <span class="menuText"> Home</span>
                </a>
                <a href="#" class="sidebar-item sidebar-item-hover-default" v-bind:class="{'sidebar-item-toggled': isShowMenuIcon, 'sidebar-item-toggled-hover': isHoverSubMenuManage }" v-on:click="toggleManage" @mouseover="hoverMenuManage" @mouseout="closeMenuManage">
                    <span class="menuIcon"><i class="fa fa-list-alt"></i></span>
                    <span class="menuText"> Manage</span>
                    <span v-if="isShowMenuList">
                        <span class="float-right menuIcon-2" v-if="isShowSubMenuManage"><i class="fa fa-chevron-up"></i></span>
                        <span class="float-right menuIcon-2" v-else><i class="fa fa-chevron-down"></i></span>
                    </span>
                </a>
                <div class="subsidebar subsidebar-default" v-bind:class="{'subsidebar-toggled': isShowSubMenuManage,'subsidebar-icon-toggled': isHoverSubMenuManage}" @mouseover="hoverMenuManage" @mouseout="closeMenuManage">
                    <a href="#" class="sidebar-item sidebar-item-hover-default">
                        <span class="menuText">Events</span>
                    </a>
                    <a href="#" class="sidebar-item sidebar-item-hover-default">
                        <span class="menuText">Events alias</span>
                    </a>
                </div>
            </div>
            <div class="content" v-bind:class="{'content-toggled': isShowMenuIcon}">
                <div class="w3-container">
                <h2>Hello</h2>
                <p>In this example, we have added a dropdown menu inside the sidebar.</p>
                <p>Notice the caret-down icon, which we use to indicate that this is a dropdown menu.</p>
                <br><br><br><br>
                <p>@yield('access_level')</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    {{-- <script src="/js/app.js" charset="utf-8"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script>
        new Vue({
            el: '#dashboard',
            data: {
                isShowMenuList: true,
                isShowMenuIcon: false,
                isOverlayToggled: false,
                isHoverSubMenuHome: false,
                isShowSubMenuManage: false,
                isHoverSubMenuManage: false
            },
            methods: {
                lessMoreMenu: function () {
                    this.isShowMenuList = !this.isShowMenuList;
                    this.isShowMenuIcon = !this.isShowMenuIcon;
                },
                toggleOverlay: function () {
                    this.isOverlayToggled = !this.isOverlayToggled;
                },
                toggleManage: function () {
                    this.isShowSubMenuManage = !this.isShowSubMenuManage;
                },
                hoverMenuHome: function () {
                    if (this.isShowMenuIcon) {
                        this.isHoverSubMenuHome = true;
                    }
                },
                closeMenuHome: function () {
                    if (this.isShowMenuIcon) {
                        this.isHoverSubMenuHome = false;
                    }
                },
                hoverMenuManage: function () {
                    if (this.isShowMenuIcon) {
                        this.isShowSubMenuManage = true;
                        this.isHoverSubMenuManage = true;
                    }
                },
                closeMenuManage: function () {
                    if (this.isShowMenuIcon) {
                        this.isHoverSubMenuManage = false;
                        this.isShowSubMenuManage = false;
                    }
                }
            }
        });
    </script>
</body>
</html>
