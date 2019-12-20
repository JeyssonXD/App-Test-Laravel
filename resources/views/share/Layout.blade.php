<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{Route('homeIndex')}}/template/concept/assets/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{Route('homeIndex')}}/template/concept/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
        <link rel="stylesheet" href="{{Route('homeIndex')}}/template/concept/assets/libs/css/style.css">
        <link rel="stylesheet" href="{{Route('homeIndex')}}/template/concept/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
        <link rel="stylesheet" href="{{Route('homeIndex')}}/template/concept/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="{{Route('homeIndex')}}/template/concept/assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
        <title>Laravel</title>
    </head>
    <body>
        <!-- ============================================================== -->
        <!-- main wrapper -->
        <!-- ============================================================== -->
        <div class="dashboard-main-wrapper">
            <!-- ============================================================== -->
            <!-- navbar -->
            <!-- ============================================================== -->
            <div class="dashboard-header">
                <nav class="navbar navbar-expand-lg bg-white fixed-top">
                    <a class="navbar-brand" href="{{Route('homeIndex')}}">App-Test</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse " id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto navbar-right-top">
                            <li class="nav-item">
                                <div id="custom-search" class="top-search-bar">
                                    <input class="form-control" type="text" placeholder="Search..">
                                </div>
                            </li>
                            <li class="nav-item dropdown nav-user">
                                <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i></a>
                                <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                    <div class="nav-user-info">
                                        <h5 class="mb-0 text-white nav-user-name">Test user</h5>
                                    </div>
                                    <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Account</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-power-off mr-2"></i>Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <!-- ============================================================== -->
            <!-- end navbar -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- left sidebar -->
            <!-- ============================================================== -->
            <div class="nav-left-sidebar sidebar-dark">
                <div class="menu-list">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="d-xl-none d-lg-none" href="#">Opciones</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav flex-column">
                                <li class="nav-divider">
                                    Menu
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-briefcase"></i>Cruds</a>
                                    <div id="submenu-2" class="collapse submenu" style="">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="pages/general.html"><i class="fa fa-fw fa-user"></i>Person</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('productCreate')}}"><i class="fa fa-fw fa-box"></i>Product</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="pages/listgroup.html"><i class="fa fa-fw fa-boxes"></i>Type Product</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end left sidebar -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- wrapper  -->
            <!-- ============================================================== -->
            <div class="dashboard-wrapper">
                <div class="dashboard-ecommerce">
                    <div class="container-fluid dashboard-content ">
                        <!-- ============================================================== -->
                        <!-- pageheader  -->
                        <!-- ============================================================== -->

                            @yield("Breadcumbs")

                        <!-- ============================================================== -->
                        <!-- end pageheader  -->
                        <!-- ============================================================== -->
                    </div>
                </div>

                <div>
                    <!-- ============================================================== -->
                    <!-- section  content -->
                    <!-- ============================================================== -->
                    
                        @yield('content')

                    <!-- ============================================================== -->
                    <!-- end section  content -->
                    <!-- ============================================================== -->

                </div>
                
            </div>
            <!-- ============================================================== -->
            <!-- end wrapper  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- Optional JavaScript -->
        <!-- jquery 3.3.1 -->
        <script src="{{Route('homeIndex')}}/template/concept/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
        <!-- bootstapndle js -->
        <script src="{{Route('homeIndex')}}/template/concept/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
        <!-- slimscrojs -->
        <script src="{{Route('homeIndex')}}/template/concept/assets/vendor/slimscroll/jquery.slimscroll.js"></script>
        <!-- main js -->
        <script src="{{Route('homeIndex')}}/template/concept/assets/libs/js/main-js.js"></script>
    </body>
</html>
