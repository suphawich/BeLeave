<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    @stack('style')
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
                            <a href="#" class="username"><span><i class="fa fa-user"></i></span><span> Fullname Lastname</span></a>
                            <a href="#"><span><i class="fa fa-sign-out"></i></span><span> Log Out</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="sidebar sidebar-default" v-bind:class="{'sidebar-toggled': isShowMenuIcon}">
                <a href="#" class="sidebar-item sidebar-item-hover-default" v-if="isShowMenuList" v-on:click="lessMoreMenu">
                    <span class="leftArrowIcon menuIcon"><i class="fa fa-chevron-left"></i></span>
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
                <p>@{{ isShowSubMenuManage }}</p>
                <p>@{{ isHoverSubMenuManage }}</p>
                </div>
            </div>
        </div>
    </div>
    @stack('script')
</body>
</html>
