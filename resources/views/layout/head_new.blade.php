<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cfnapa.com/wp-content/uploads/2016/05/QA-Logo-Design-300.jpg" type="image/gif" sizes="16x16">
    <title>
        @yield('title')
    </title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="{{URL::to('/')}}/css/bootstrap.css">

    <!-- css -->
    <link rel="stylesheet" href="{{URL::to('/')}}/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Salsa" />
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <style>
        @yield('css')
    </style>


</head>

<body>
@yield('body')
<div class="bg-cover">
    <div class="display">

    </div>
    <div class="qa-login col-md-6">
        <div class="col-md-12 login"><!-- col-md-9 Begin -->
            <div class="row">
                <div class="col-sm-6 img-login">
                    <img class="img-responsive" src="{{URL::to('/')}}/img/signin-image.jpg"/></div>
                <div class="col-sm-6">
                    <h2 id="signup">Sign In</h2>
                    <form method="post" action="#">
                        <div class="email">
                            <label><i class="fa fa-envelope"></i></label>
                            <input type="email" placeholder="Your Email" name="email-login" id="email-login" required>
                        </div>
                        <div class="password">
                            <label><i class="fa fa-lock"></i></label>
                            <input type="password" placeholder="Password" name="password-login" id="password-login" required>
                        </div>
                        <div class="remember">
                            <input type="checkbox" name="remember" id="remember"><label for="remember"><span>Remember me</span></label>
                        </div>
                        <input type="submit" value="Login">
                    </form>
                </div>
            </div>
            <div class="link-to-register">
                <a id="sign-up-here" href="#">Sign up here</a>
            </div>
        </div>
        <div class="col-md-12 register">
            <div class="link-to-login">
                <a id="login-here" href="#"><i style="margin-right: 5px" class="fas fa-arrow-left"></i> Sign in</a>
            </div>
            <div class="row">
                <div class="col-sm-6 register-form">
                    <h2 id="signup-register">Sign Up</h2>
                    <form action="#" method="post" enctype="multipart/form-data">
                        <div class="username">
                            <label><i class="fas fa-user"></i></label>
                            <input type="text" placeholder="Your Name" name="name" id="name">
                        </div>
                        <div class="email">
                            <label><i class="fa fa-envelope"></i></label>
                            <input type="email" placeholder="Your Email" name="email-register" id="email-register">
                        </div>
                        <div class="password">
                            <label><i class="fa fa-lock"></i></label>
                            <input type="password" placeholder="Password" name="password-register" id="password-register">
                        </div>
                        <div class="password">
                            <label><i class="fa fa-lock"></i></label>
                            <input type="password" placeholder="Re-password" name="repassword-register" id="repassword-register">
                        </div>
                        <input type="submit" value="Register">
                    </form>
                </div>
                <div class="col-sm-6 register-img">
                    <img class="img-responsive" src="{{URL::to('/')}}/img/signup-image.jpg">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/c567c646bc.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="{{URL::to('/')}}/js/bootstrap.js"></script>
<script>
    $(document).ready(function(){
        $('.login-register').click(function () {
            $('.register').removeClass('show-register');
            $('.login').addClass('show-login');
            $('.bg-cover').addClass('show-bg-cover');
            $('body').addClass('stop-scrolling');
        });
        $('#sign-up-here').click(function () {
            $('.login').removeClass('show-login');
            $('.register').addClass('show-register');
        });
        $('#login-here').click(function () {
            $('.login').addClass('show-login');
            $('.register').removeClass('show-register');
        });
        $('.display').click(function () {
            $('.bg-cover').removeClass('show-bg-cover');
            $('body').removeClass('stop-scrolling');
        })
    });
</script>

    @yield('script')
</body>
</html>
