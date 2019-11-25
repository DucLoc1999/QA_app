@extends('layout.header_bar')
@section('css')
<style type="text/css">

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
        margin: 30px auto;
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
    .login-form {
        width: 350px;
        margin: 75px auto;
        text-align: center;
    }
</style>
@stop
@section('login-reg')
    <div class="login-form">
        <form action="{{route('post_register')}}" method="post">
            @csrf
            <h2 class="text-center">Đăng ký</h2>
            @if ($errors->any())
                <div class="alert-danger">
                    <ul style="list-style: none;padding: 0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group has-error">
                <input type="text" class="form-control" name="name" placeholder="Tên tài khoản" required="required">
            </div>
            <div class="form-group has-error">
                <input type="email" class="form-control" name="email" placeholder="Email" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Đăng ký</button>
            </div>
        </form>

    </div>
@stop

