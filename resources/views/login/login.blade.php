@extends('layout.header_bar')
@section('css')
    <style type="text/css">
        body {
            color: #fff;
            background: #f7f7f7;
        }
        .form-control {
            min-height: 41px;
            background: #f2f2f2;
            box-shadow: none !important;
            border: transparent;
        }
        .form-control:focus {
            background: #e2e2e2;
        }
        .form-control, .btn {
            border-radius: 2px;
        }
        .login-form {
            width: 350px;
            margin: 65px auto;
            text-align: center;
        }
        .login-form h2 {
            margin: 10px 0 25px;
        }
        .login-form form {
            color: #7a7a7a;
            border-radius: 3px;
            margin-bottom: 15px;
            background: #fff;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }
        .login-form .btn {
            font-size: 16px;
            font-weight: bold;
            background: #3598dc;
            border: none;
            outline: none !important;
        }
        .login-form .btn:hover, .login-form .btn:focus {
            background: #2389cd;
        }
        .login-form a {
            color: #fff;
            text-decoration: underline;
        }
        .login-form a:hover {
            text-decoration: none;
        }
        .login-form form a {
            color: #7a7a7a;
            text-decoration: none;
        }
        .login-form form a:hover {
            text-decoration: underline;
        }
        .form-remember {
            padding-bottom: 10px;
            margin: 0px;
        }
    </style>
@stop
@section('login-reg')
    <div class="login-form">
        <form action="{{route('post_login')}}" method="post">
            @csrf
            <h2 class="text-center">Login</h2>
            @if (session('error'))
                <div style="padding-bottom: 5px" class="alert alert-danger">
                    <p style="font-size: 12px">{{ session('error') }}</p>
                </div>
            @endif
            <div class="form-group has-error">
                <input type="email" class="form-control" name="email" placeholder="Email" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required="required">
            </div>
            <div class="form-remember">
                <input type="checkbox" name="remember"><span style="font-size: 11px">Remember</span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
            </div>
        </form>
        <p class="text-center small">Don't have an account? <a href="#">Sign up here!</a></p>
    </div>
@stop
