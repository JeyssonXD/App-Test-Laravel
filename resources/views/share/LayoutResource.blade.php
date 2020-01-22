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
        <link rel="stylesheet" href="{{Route('homeIndex')}}/template/concept/assets/vendor/chosen/chosen.min.css">
        @yield('CustomHeader')
        <title>Laravel</title>
    </head>
    <body>

        <!-- ============================================================== -->
        <!-- section  content -->
        <!-- ============================================================== -->
        
            @yield('content')

        <!-- ============================================================== -->
        <!-- end section  content -->
        <!-- ============================================================== -->
        
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
        <!-- jquery js -->
        <script src="{{Route('homeIndex')}}/template/concept/assets/vendor/chosen/chosen.jquery.min.js"></script>
        <script src="{{Route('homeIndex')}}/template/concept/assets/vendor/chosen/chosen.proto.min.js"></script>
        <!--Custom js-->
        @yield('CustomJs')
    </body>
</html>
