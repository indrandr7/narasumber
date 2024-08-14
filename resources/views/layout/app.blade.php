<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" /> 
  <title>SiNara</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/summernote/summernote-bs4.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('lte/plugins/toastr/toastr.min.css') }}">

  <!-- jQuery -->
  <script src="{{ asset('lte/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('lte/plugins/moment/moment.min.js')}}"></script>
  <script src="{{ asset('lte/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- Summernote -->
  <script src="{{ asset('lte/plugins/summernote/summernote-bs4.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('lte/dist/js/adminlte.js')}}"></script>
  {{-- Datatables --}}
  <script src="{{ asset('lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('lte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('lte/plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('lte/plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('lte/plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
  <!-- Select2 -->
  <script src="{{ asset('lte/plugins/select2/js/select2.full.min.js') }}"></script>
  <!-- Form Validation -->
	<script src="{{ asset('lte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('lte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
  {{-- Fungsi custom umum --}}
  <script src="{{ asset('myfunctions.js') }}"></script>
  <!-- Toastr -->
  <script src="{{ asset('lte/plugins/toastr/toastr.min.js') }}"></script>
  <script src="{{ asset('sweetalert.min.js') }}"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    @include('layout.navigation')
    @yield('content')

    <aside class="control-sidebar control-sidebar-dark"></aside>
  </div>

  @include('layout.footer')
</body>
</html>
