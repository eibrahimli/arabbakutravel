<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin Panel</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('backend/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="{{ asset('backend/assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

  <!-- Custom fonts for this template -->
  <link href="{{ asset('backend/assets/plugins/themify/css/themify.css') }}" rel="stylesheet" type="text/css">

  <!-- Angular Tooltip Css -->
  <link href="{{ asset('backend/assets/plugins/angular-tooltip/angular-tooltips.css') }}" rel="stylesheet">

  <!-- Morris Charts CSS -->
  <link href="{{ asset('backend/assets/plugins/morris.js/morris.css') }}" rel="stylesheet">

  <!-- Page level plugin CSS -->
  <link href="{{ asset('backend/css/animate.css') }}" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{ asset('backend/css/glovia.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/css/glovia-responsive.css') }}" rel="stylesheet">

  <!-- Custom styles for Color -->
  <link href="{{asset('backend/css/skins/default.css')}}" rel="stylesheet">

  @yield('css')
</head>

<body class="fixed-nav sticky-footer" id="page-top">

<!-- ===============================
  Navigation Start
====================================-->
@include("backend.inc.nav")
<!-- =====================================================
                    End Navigations
======================================================= -->

<div class="content-wrapper">
  <div class="container-fluid">

    <!-- Title & Breadcrumbs-->
    <div class="row page-titles">
      <div class="col-md-12 align-self-center">
        <h4 class="theme-cl">@yield('whereiam')</h4>
      </div>
    </div>
    <!-- Title & Breadcrumbs-->

    @yield('content')

  <!-- Footer -->
  <footer class="sticky-footer">
    <div class="container">
      <div class="text-center">
        <small class="font-15">Copyright © Created By Elvir İbrahimli <i class="fa fa-heart cl-danger"></i> In Azerbaijan</small>
      </div>
    </div>
  </footer>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded cl-white gredient-bg" href="#page-top">
    <i class="ti-angle-double-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('backend/assets/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('backend/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('backend/assets/plugins/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Slick Slider Js -->
  <script src="{{ asset('backend/assets/plugins/slick-slider/slick.js') }}"></script>

  <!-- Slim Scroll -->
  <script src="{{ asset('backend/assets/plugins/slim-scroll/jquery.slimscroll.min.js') }}"></script>

  <!-- Angular Tooltip -->
  <script src="{{ asset('backend/assets/plugins/angular-tooltip/angular.js') }}"></script>
  <script src="{{ asset('backend/assets/plugins/angular-tooltip/angular-tooltips.js') }}"></script>
  <script src="{{ asset('backend/assets/plugins/angular-tooltip/index.js') }}"></script>

  <!-- Morris.js charts -->
  <script src="{{ asset('backend/assets/plugins/raphael/raphael.min.js') }}"></script>
  <script src="{{ asset('backend/assets/plugins/morris.js/morris.min.js') }}"></script>
  <script src="{{ asset('backend/templateEditor/ckeditor/ckeditor.js') }}"></script>

  <!-- Custom Chart JavaScript -->
  <script src="{{ asset('backend/js/custom/dashboard/dashboard-2.js') }}"></script>

  <!-- Custom scripts for all pages -->
  <script src="{{ asset('backend/js/glovia.js') }}"></script>

  @yield('js')

  <script>
      $('.dropdown-toggle').dropdown();
      CKEDITOR.replace('ckeditor');
  </script>

</div>
<!-- Wrapper -->

</body>
</html>
