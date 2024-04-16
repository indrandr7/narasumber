<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nara</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css')}}">
  </head>

  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="../../index2.html" class="h1"><b>Nara</b></a>
          <p class="login-box-msg">Sistem Informasi Narasumber</p>
        </div>
        <div class="card-body">
          
          @if($errors->any())
          <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
              <p style="text-align:center;margin-top:0px;margin-bottom:0px;font-size:14px;">{{ $error }}</p>      
            @endforeach
          </div>
          @endif

          <form action="{{ url('/auth') }}" method="post">
            @csrf
            <div class="input-group mb-3">
              <input type="input" name="username" id="username" class="form-control  @error('username') is-invalid @enderror" placeholder="Username">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="password" id="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8"></div>
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('lte/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('lte/dist/js/adminlte.min.js')}}"></script>
  </body>
</html>
