





<!-- test -->







<html>
  <head>
    <title>Questions and answers</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    @yield('head')
  </head>
  <body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="navbar-brand" href="#"><img src="http://qa.uet.vnu.edu.vn/qa/public/img/uet_logo.png" alt="Logo" height="42" width="42"></a>
        </li>
      </ul>
      <ul class="navbar-nav justify-content-end">
        <li class="nav-item">
          <a class="nav-link" href="#">Đăng nhập</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Thông tin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>
      </ul>
    </nav>

    @yield('body')
    @yield('script')
  </body>
</html>
