<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Đăng nhập</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{asset('css/simplebar.css')}}">

    <link rel="stylesheet" href="{{asset('css/logo.css')}}">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{asset('css/feather.css')}}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{asset('css/daterangepicker.css')}}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{asset('css/app-light.css')}}" id="lightTheme">
    <link rel="stylesheet" href="{{asset('css/app-dark.css')}}" id="darkTheme" disabled>
  </head>
  <body class="light">
    <div class="wrapper vh-100">
      <div class="d-flex justify-content-center align-items-center h-100">
        <form method="POST" action="{{route('login.post')}}" class="col-lg-3 col-md-4 col-10 mx-auto text-center">
            @csrf
          <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{route('login.view')}}">
            <img class="logo" src="{{ asset('assets/images/logo.ico')}}" alt="" >
          </a>
          <h1 class="h3 mb-3">Đăng nhập</h1>
          @if (Session::has('error'))
          <div class="alert alert-danger text-left">{{ Session::get('error') }}</div>
        @endif
          <div class="form-group">
            <label for="username" class="sr-only">Tên đăng nhập</label>
            <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="Tên đăng nhập" required autofocus="">
          </div>
          <div class="form-group">
            <label for="inputPassword" class="sr-only">Mật khẩu</label>
            <input type="password" id="inputPassword" name="password" class="form-control form-control-lg" placeholder="Mật khẩu" required>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Đăng nhập</button>
        </form>
      </div>
    </div>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/simplebar.min.js')}}"></script>
    <script src='{{asset('js/daterangepicker.js')}}'></script>
    <script src='{{asset('js/jquery.stickOnScroll.js')}}'></script>
    <script src="{{asset('js/tinycolor-min.js')}}"></script>
    <script src="{{asset('js/config.js')}}"></script>
    <script src="{{asset('js/apps.js')}}"></script>
    <!-- Global site tag (gtag.js')}}) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag()
      {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-56159088-1');
    </script>
  </body>
</html>
</body>
</html>
