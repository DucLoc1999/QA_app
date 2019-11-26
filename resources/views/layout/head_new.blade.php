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
    @yield('link')
    <style>
        .dropbtn {
            background-color: #4CAF50;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {background-color: #f1f1f1}

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #2a5f8e;
        }
        .dropbtn {
            background-color: #3a80bb;
            color: white;
            padding: 8px 25px;
            font-size: 15px;
            border: none;
            cursor: pointer;
        }
        .dropdown {
            position: relative;
            left: 8px;
            top: 15px;
            display: inline-block;
        }
    </style>

    <style>

    @yield('css')
    </style>


</head>

<body>
@yield('body')

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
