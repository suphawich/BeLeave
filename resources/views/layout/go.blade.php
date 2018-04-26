<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

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
                        <a href="dashboard"><img src="/images/logo.png" class="logo" alt="logo website"></a>
                    </div>
                    <div class="col"></div>
                    <div class="col-lg-5 col-xl-4 d-none d-sm-none d-md-none d-lg-block">
                        <div class="row float-right topnav">
                            <a href="#"><span><i class="fa fa-bell"></i></span><span class="badge badge-pill badge-dark">2</span> </a>
                            <a href="/users/{{ Auth::user()->id }}/edit" class="username"><span><i class="fa fa-user"></i></span><span>{{ Auth::user()->full_name }}</span></a>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span><i class="fa fa-sign-out"></i></span><span> Log Out</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (Auth::user()->access_level == 'Administrator')
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
                    <a href="/dashboard" class="sidebar-item sidebar-item-hover-default" v-bind:class="{'sidebar-item-toggled': isShowMenuIcon, 'sidebar-item-toggled-hover': isHoverSubMenuHome}" @mouseover="hoverMenuHome" @mouseout="closeMenuHome">
                        <span class="menuIcon"><i class="fa fa-home"></i></span>
                        <span class="menuText"> Home</span>
                    </a>
                    <a href="#" class="sidebar-item sidebar-item-hover-default" v-bind:class="{'sidebar-item-toggled': isShowMenuIcon, 'sidebar-item-toggled-hover': isHoverSubMenuAccounts}" v-on:click="toggleAccounts" @mouseover="hoverMenuAccounts" @mouseout="closeMenuAccounts">
                        <span class="menuIcon"><i class="fa fa-users"></i></span>
                        <span class="menuText"> Account</span>
                        <span v-if="isShowMenuList">
                            <span class="float-right menuIcon-2" v-if="isShowSubMenuAccounts"><i class="fa fa-chevron-up"></i></span>
                            <span class="float-right menuIcon-2" v-else><i class="fa fa-chevron-down"></i></span>
                        </span>
                    </a>
                    <div class="subsidebar subsidebar-default" v-bind:class="{'subsidebar-toggled': isShowSubMenuAccounts,'subsidebar-icon-toggled': isHoverSubMenuAccounts,'subsidebar-transition': !isShowMenuIcon}" @mouseover="hoverMenuAccounts" @mouseout="closeMenuAccounts">
                        <a href="/users/{{ Auth::user()->id }}/edit" class="sidebar-item sidebar-item-hover-default">
                            <span class="menuText">Personalization</span>
                        </a>
                        <a href="/subscription/{{ Auth::user()->id}}" class="sidebar-item sidebar-item-hover-default">
                            <span class="menuText">Subscription</span>
                        </a>
                        <a href="/users" class="sidebar-item sidebar-item-hover-default">
                            <span class="menuText">Users</span>
                        </a>
                    </div>
                    <a href="#" class="sidebar-item sidebar-item-hover-default" v-bind:class="{'sidebar-item-toggled': isShowMenuIcon, 'sidebar-item-toggled-hover': isHoverSubMenuAnalytics}" v-on:click="toggleAnalytics" @mouseover="hoverMenuAnalytics" @mouseout="closeMenuAnalytics">
                        <span class="menuIcon"><i class="fa fa-signal"></i></span>
                        <span class="menuText"> Analytics</span>
                        <span v-if="isShowMenuList">
                            <span class="float-right menuIcon-2" v-if="isShowSubMenuAnalytics"><i class="fa fa-chevron-up"></i></span>
                            <span class="float-right menuIcon-2" v-else><i class="fa fa-chevron-down"></i></span>
                        </span>
                    </a>
                    <div class="subsidebar subsidebar-default" v-bind:class="{'subsidebar-toggled': isShowSubMenuAnalytics,'subsidebar-icon-toggled': isHoverSubMenuAnalytics,'subsidebar-transition': !isShowMenuIcon}" @mouseover="hoverMenuAnalytics" @mouseout="closeMenuAnalytics">
                        <a href="/graph" class="sidebar-item sidebar-item-hover-default">
                            <span class="menuText">Graph</span>
                        </a>
                        <a href="#" class="sidebar-item sidebar-item-hover-default">
                            <span class="menuText">Leave tracking</span>
                        </a>
                    </div>
                </div>
                <div class="content" v-bind:class="{'content-toggled': isShowMenuIcon}">
                    <div class="w3-container"  ">

                        @yield('content')

                    </div>
                </div>
            </div>
        @elseif (Auth::user()->access_level == 'Manager' || Auth::user()->access_level == 'Guest')
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
                    <a href="/dashboard" class="sidebar-item sidebar-item-hover-default" v-bind:class="{'sidebar-item-toggled': isShowMenuIcon, 'sidebar-item-toggled-hover': isHoverSubMenuHome}" @mouseover="hoverMenuHome" @mouseout="closeMenuHome">
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
                    <div class="subsidebar subsidebar-default" v-bind:class="{'subsidebar-toggled': isShowSubMenuManage,'subsidebar-icon-toggled': isHoverSubMenuManage,'subsidebar-transition': !isShowMenuIcon}" @mouseover="hoverMenuManage" @mouseout="closeMenuManage">
                        <a href="/manage/request" class="sidebar-item sidebar-item-hover-default">
                            <span class="menuText">Request</span>
                        </a>
                        <a href="/manage/request/leave" class="sidebar-item sidebar-item-hover-default">
                            <span class="menuText">Request Leave</span>
                        </a>
                        <a href="/history" class="sidebar-item sidebar-item-hover-default">
                            <span class="menuText">Leave history</span>
                        </a>
                    </div>
                    <a href="#" class="sidebar-item sidebar-item-hover-default" v-bind:class="{'sidebar-item-toggled': isShowMenuIcon, 'sidebar-item-toggled-hover': isHoverSubMenuAnalytics}" v-on:click="toggleAnalytics" @mouseover="hoverMenuAnalytics" @mouseout="closeMenuAnalytics">
                        <span class="menuIcon"><i class="fa fa-signal"></i></span>
                        <span class="menuText"> Analytics</span>
                        <span v-if="isShowMenuList">
                            <span class="float-right menuIcon-2" v-if="isShowSubMenuAnalytics"><i class="fa fa-chevron-up"></i></span>
                            <span class="float-right menuIcon-2" v-else><i class="fa fa-chevron-down"></i></span>
                        </span>
                    </a>
                    <div class="subsidebar subsidebar-default" v-bind:class="{'subsidebar-toggled': isShowSubMenuAnalytics,'subsidebar-icon-toggled': isHoverSubMenuAnalytics,'subsidebar-transition': !isShowMenuIcon}" @mouseover="hoverMenuAnalytics" @mouseout="closeMenuAnalytics">
                        <a href="/graph" class="sidebar-item sidebar-item-hover-default">
                            <span class="menuText">Graph</span>
                        </a>
                        <a href="#" class="sidebar-item sidebar-item-hover-default">
                            <span class="menuText">Leave tracking</span>
                        </a>
                    </div>
                    <a href="#" class="sidebar-item sidebar-item-hover-default" v-bind:class="{'sidebar-item-toggled': isShowMenuIcon, 'sidebar-item-toggled-hover': isHoverSubMenuAccounts}" v-on:click="toggleAccounts" @mouseover="hoverMenuAccounts" @mouseout="closeMenuAccounts">
                        <span class="menuIcon"><i class="fa fa-users"></i></span>
                        <span class="menuText"> Account</span>
                        <span v-if="isShowMenuList">
                            <span class="float-right menuIcon-2" v-if="isShowSubMenuAccounts"><i class="fa fa-chevron-up"></i></span>
                            <span class="float-right menuIcon-2" v-else><i class="fa fa-chevron-down"></i></span>
                        </span>
                    </a>
                    <div class="subsidebar subsidebar-default" v-bind:class="{'subsidebar-toggled': isShowSubMenuAccounts,'subsidebar-icon-toggled': isHoverSubMenuAccounts,'subsidebar-transition': !isShowMenuIcon}" @mouseover="hoverMenuAccounts" @mouseout="closeMenuAccounts">
                        <a href="/users/{{ Auth::user()->id }}/edit" class="sidebar-item sidebar-item-hover-default">
                            <span class="menuText">Personalization</span>
                        </a>
                        <a href="/subscription/{{ Auth::user()->id}}" class="sidebar-item sidebar-item-hover-default">
                            <span class="menuText">Subscription</span>
                        </a>
                        <a href="/users" class="sidebar-item sidebar-item-hover-default">
                            <span class="menuText">Users</span>
                        </a>
                    </div>
                    <a href="#" class="sidebar-item sidebar-item-hover-default" v-bind:class="{'sidebar-item-toggled': isShowMenuIcon, 'sidebar-item-toggled-hover': isHoverSubMenuSetting}" @mouseover="hoverMenuSetting" @mouseout="closeMenuSetting">
                        <span class="menuIcon"><i class="fa fa-cog"></i></span>
                        <span class="menuText"> Setting</span>
                    </a>
                </div>
                <div class="content" v-bind:class="{'content-toggled': isShowMenuIcon}">
                    <div class="w3-container"  >
                        @yield('content')
                    </div>
                </div>
            </div>
        @elseif (Auth::user()->access_level == 'Supervisor')
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
                    <a href="/dashboard" class="sidebar-item sidebar-item-hover-default" v-bind:class="{'sidebar-item-toggled': isShowMenuIcon, 'sidebar-item-toggled-hover': isHoverSubMenuHome}" @mouseover="hoverMenuHome" @mouseout="closeMenuHome">
                        <span class="menuIcon"><i class="fa fa-home"></i></span>
                        <span class="menuText"> Home</span>
                    </a>
                    <a href="/leave" class="sidebar-item sidebar-item-hover-default" v-bind:class="{'sidebar-item-toggled': isShowMenuIcon, 'sidebar-item-toggled-hover': isHoverSubMenuLeave}" @mouseover="hoverMenuLeave" @mouseout="closeMenuLeave">
                        <span class="menuIcon"><i class="fa fa-pencil-square-o"></i></span>
                        <span class="menuText"> Leave</span>
                    </a>
                    <a href="#" class="sidebar-item sidebar-item-hover-default" v-bind:class="{'sidebar-item-toggled': isShowMenuIcon, 'sidebar-item-toggled-hover': isHoverSubMenuManage }" v-on:click="toggleManage" @mouseover="hoverMenuManage" @mouseout="closeMenuManage">
                        <span class="menuIcon"><i class="fa fa-list-alt"></i></span>
                        <span class="menuText"> Manage</span>
                        <span v-if="isShowMenuList">
                            <span class="float-right menuIcon-2" v-if="isShowSubMenuManage"><i class="fa fa-chevron-up"></i></span>
                            <span class="float-right menuIcon-2" v-else><i class="fa fa-chevron-down"></i></span>
                        </span>
                    </a>
                    <div class="subsidebar subsidebar-default" v-bind:class="{'subsidebar-toggled': isShowSubMenuManage,'subsidebar-icon-toggled': isHoverSubMenuManage,'subsidebar-transition': !isShowMenuIcon}" @mouseover="hoverMenuManage" @mouseout="closeMenuManage">
                        <a href="/manage/request" class="sidebar-item sidebar-item-hover-default">
                            <span class="menuText">Request</span>
                        </a>
                        <a href="/manage/request/leave" class="sidebar-item sidebar-item-hover-default">
                            <span class="menuText">Request Leave</span>
                        </a>
                        <a href="#" class="sidebar-item sidebar-item-hover-default">
                            <span class="menuText">Leave history</span>
                        </a>
                    </div>
                    <a href="#" class="sidebar-item sidebar-item-hover-default" v-bind:class="{'sidebar-item-toggled': isShowMenuIcon, 'sidebar-item-toggled-hover': isHoverSubMenuAccounts}" v-on:click="toggleAccounts" @mouseover="hoverMenuAccounts" @mouseout="closeMenuAccounts">
                        <span class="menuIcon"><i class="fa fa-users"></i></span>
                        <span class="menuText"> Account</span>
                        <span v-if="isShowMenuList">
                            <span class="float-right menuIcon-2" v-if="isShowSubMenuAccounts"><i class="fa fa-chevron-up"></i></span>
                            <span class="float-right menuIcon-2" v-else><i class="fa fa-chevron-down"></i></span>
                        </span>
                    </a>
                    <div class="subsidebar subsidebar-default" v-bind:class="{'subsidebar-toggled': isShowSubMenuAccounts,'subsidebar-icon-toggled': isHoverSubMenuAccounts,'subsidebar-transition': !isShowMenuIcon}" @mouseover="hoverMenuAccounts" @mouseout="closeMenuAccounts">
                        <a href="/users/{{ Auth::user()->id }}/edit" class="sidebar-item sidebar-item-hover-default">
                            <span class="menuText">Personalization</span>
                        </a>
                        <a href="/subscription" class="sidebar-item sidebar-item-hover-default">
                            <span class="menuText">Subscription</span>
                        </a>
                        <a href="/users" class="sidebar-item sidebar-item-hover-default">
                            <span class="menuText">Users</span>
                        </a>
                    </div>
                    <a href="/setting" class="sidebar-item sidebar-item-hover-default" v-bind:class="{'sidebar-item-toggled': isShowMenuIcon, 'sidebar-item-toggled-hover': isHoverSubMenuSetting}" @mouseover="hoverMenuSetting" @mouseout="closeMenuSetting">
                        <span class="menuIcon"><i class="fa fa-cog"></i></span>
                        <span class="menuText"> Setting</span>
                    </a>
                </div>
                <div class="content" v-bind:class="{'content-toggled': isShowMenuIcon}">
                    <div class="w3-container">
                        @yield('content')
                    </div>
                </div>
            </div>
        @elseif (Auth::user()->access_level == 'Subordinate')
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
                    <a href="/dashboard" class="sidebar-item sidebar-item-hover-default" v-bind:class="{'sidebar-item-toggled': isShowMenuIcon, 'sidebar-item-toggled-hover': isHoverSubMenuHome}" @mouseover="hoverMenuHome" @mouseout="closeMenuHome">
                        <span class="menuIcon"><i class="fa fa-home"></i></span>
                        <span class="menuText"> Home</span>
                    </a>
                    <a href="/leave" class="sidebar-item sidebar-item-hover-default" v-bind:class="{'sidebar-item-toggled': isShowMenuIcon, 'sidebar-item-toggled-hover': isHoverSubMenuLeave}" @mouseover="hoverMenuLeave" @mouseout="closeMenuLeave">
                        <span class="menuIcon"><i class="fa fa-pencil-square-o"></i></span>
                        <span class="menuText"> Leave</span>
                    </a>
                    <a href="/users/{{ Auth::user()->id }}/edit" class="sidebar-item sidebar-item-hover-default" v-bind:class="{'sidebar-item-toggled': isShowMenuIcon, 'sidebar-item-toggled-hover': isHoverSubMenuPersonal}" @mouseover="hoverMenuPersonal" @mouseout="closeMenuPersonal">
                        <span class="menuIcon"><i class="fa fa-user"></i></span>
                        <span class="menuText"> Prosonalization</span>
                    </a>
                    <a href="/setting" class="sidebar-item sidebar-item-hover-default" v-bind:class="{'sidebar-item-toggled': isShowMenuIcon, 'sidebar-item-toggled-hover': isHoverSubMenuSetting}" @mouseover="hoverMenuSetting" @mouseout="closeMenuSetting">
                        <span class="menuIcon"><i class="fa fa-cog"></i></span>
                        <span class="menuText"> Setting</span>
                    </a>
                </div>
                <div class="content" v-bind:class="{'content-toggled': isShowMenuIcon}">
                    <div class="w3-container">
                        @yield('content')
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    {{-- <script src="/js/app.js" charset="utf-8"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    @stack('script')
    <script>
        new Vue({
            el: '#dashboard',
            data: {
                isShowMenuList: true,
                isShowMenuIcon: false,
                isOverlayToggled: false,
                isHoverSubMenuHome: false,

                isShowSubMenuManage: false,
                isHoverSubMenuManage: false,

                isShowSubMenuAnalytics: false,
                isHoverSubMenuAnalytics: false,

                isShowSubMenuAccounts: false,
                isHoverSubMenuAccounts: false,

                isHoverSubMenuSetting: false,

                isHoverSubMenuLeave: false,
                isHoverSubMenuLeaveHistory: false,
                isHoverSubMenuPersonal: false,

                @yield('script-data')
            },
            mounted: function () {
                @yield('script-mounted')
            },
            methods: {
                lessMoreMenu: function () {
                    this.isShowMenuList = !this.isShowMenuList;
                    this.isShowMenuIcon = !this.isShowMenuIcon;
                    this.isShowSubMenuManage = false;
                    this.isShowSubMenuAnalytics = false;
                    this.isShowSubMenuAccounts = false;
                },
                toggleOverlay: function () {
                    this.isOverlayToggled = !this.isOverlayToggled;
                },
                toggleManage: function () {
                    this.isShowSubMenuManage = !this.isShowSubMenuManage;
                },
                toggleAnalytics: function () {
                    this.isShowSubMenuAnalytics = !this.isShowSubMenuAnalytics;
                },
                toggleAccounts: function () {
                    this.isShowSubMenuAccounts = !this.isShowSubMenuAccounts;
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
                },
                hoverMenuAnalytics: function () {
                    if (this.isShowMenuIcon) {
                        this.isShowSubMenuAnalytics = true;
                        this.isHoverSubMenuAnalytics = true;
                    }
                },
                closeMenuAnalytics: function () {
                    if (this.isShowMenuIcon) {
                        this.isHoverSubMenuAnalytics = false;
                        this.isShowSubMenuAnalytics = false;
                    }
                },
                hoverMenuAccounts: function () {
                    if (this.isShowMenuIcon) {
                        this.isShowSubMenuAccounts = true;
                        this.isHoverSubMenuAccounts = true;
                    }
                },
                closeMenuAccounts: function () {
                    if (this.isShowMenuIcon) {
                        this.isHoverSubMenuAccounts = false;
                        this.isShowSubMenuAccounts = false;
                    }
                },
                hoverMenuSetting: function () {
                    if (this.isShowMenuIcon) {
                        this.isHoverSubMenuSetting = true;
                    }
                },
                closeMenuSetting: function () {
                    if (this.isShowMenuIcon) {
                        this.isHoverSubMenuSetting = false;
                    }
                },
                hoverMenuLeave: function () {
                    if (this.isShowMenuIcon) {
                        this.isHoverSubMenuLeave = true;
                    }
                },
                closeMenuLeave: function () {
                    if (this.isShowMenuIcon) {
                        this.isHoverSubMenuLeave = false;
                    }
                },
                hoverMenuLeaveHistory: function () {
                    if (this.isShowMenuIcon) {
                        this.isHoverSubMenuLeaveHistory = true;
                    }
                },
                closeMenuLeaveHistory: function () {
                    if (this.isShowMenuIcon) {
                        this.isHoverSubMenuLeaveHistory = false;
                    }
                },
                hoverMenuPersonal: function () {
                    if (this.isShowMenuIcon) {
                        this.isHoverSubMenuPersonal = true;
                    }
                },
                closeMenuPersonal: function () {
                    if (this.isShowMenuIcon) {
                        this.isHoverSubMenuPersonal = false;
                    }
                },
                @yield('script-methods')
            }
        });
    </script>
</body>
</html>
