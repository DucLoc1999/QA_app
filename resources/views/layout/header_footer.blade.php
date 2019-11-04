





<!-- test -->







<html>
  <head>
    <title>Questions and answers</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    @yield('head')
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-expand-sm bg-primary">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#" style="height:52px; width:42px"><img style ="height: 100%; width:100%" src="http://qa.uet.vnu.edu.vn/qa/public/img/uet_logo.png" alt="Logo"></a>
        </div>
      <ul class="navbar-nav navbar-right ">
        <li class="nav-item ">
          <a class="nav-link text-dark" href="#">Đăng nhập</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="#">Thông tin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="#">Disabled</a>
        </li>
      </ul>
      </div>
    </nav>


    @yield('body')

    <div class="bg-secondary" style="position: fixed; left:0; bottom:0; width:100%"> 
      <p>footer</p>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    @yield('script')

    </body>
</html>
