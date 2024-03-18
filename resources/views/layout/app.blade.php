<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href={{asset("AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css")}}>
    <!-- Ionicons -->
    <link rel="stylesheet" href={{asset("https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css")}}>
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href={{asset("AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css")}}>
    <!-- iCheck -->
    <link rel="stylesheet" href={{asset("AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}>
    <!-- JQVMap -->
    <link rel="stylesheet" href={{asset("AdminLTE-3.2.0/plugins/jqvmap/jqvmap.min.css")}}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{asset("AdminLTE-3.2.0/dist/css/adminlte.min.css")}}>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href={{asset("AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}>
    <!-- Daterange picker -->
    <link rel="stylesheet" href={{asset("AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.css")}}>
    <!-- summernote -->
    <link rel="stylesheet" href={{asset("AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.css")}}>
</head>

<body>
    <div class="wrapper">
        <!-- Preloader -->
        <div
          class="preloader flex-column justify-content-center align-items-center"
        >
          <img
            class="animation__shake"
            src="adminLTE-3.2.0/dist/img/AdminLTELogo.png"
            alt="AdminLTELogo"
            height="60"
            width="60"
          />
        </div>
  
        <!-- Navbar -->
        @include('layout.navbar')
        <!-- /.navbar -->
  
        <!-- Main Sidebar Container -->
        @include('layout.mainSidebar')

        <!-- Content Wrapper. Contains page content -->
        @include('layout.contentWrapper')
        <!-- /.content-wrapper -->
        
        {{-- Footer --}}
        @include('layout.footer')
  
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
          <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
      </div>
      @include('layout.script')
</body>

</html>
