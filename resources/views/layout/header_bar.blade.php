<!doctype html>
<html lang="en">
@include('layout.head')
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
@yield('css')
<body>
<div class="menu">
    <div class="container-fluid">
        <div class="col-md-12 row row-header">
            <div class="col-md-2 row">
                <div class="logo" style="padding: 10px">
                    <img src="https://cfnapa.com/wp-content/uploads/2016/05/QA-Logo-Design-300.jpg" >
                </div>
            </div>
            <div class="col-md-8 form-search">
                <!--form action="#">
                    <label><input type="text"></label>
                    <i class="fa fa-search"></i>
                </form-->
            </div>
            <div class="col-md-2 col-login-reg ">
                @if(!\Illuminate\Support\Facades\Auth::check())
                <ul class="ul-login-register" style="padding: 0;list-style: none">
                    <li><a href="{{route('login')}}">Đăng nhập</a></li>
                    <li><a href="{{route('register')}}">Đăng ký</a></li>
                </ul>
                @else
                    <div class="dropdown">
                        <button class="dropbtn">{{\Illuminate\Support\Facades\Auth::user()->name}}</button>
                        <div class="dropdown-content">
                            <a href="{{route('index.user',\Illuminate\Support\Facades\Auth::id())}}">Profile user</a>
                            <a href="{{route('logout')}}">Log out</a>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@yield('content')
@yield('login-reg')
</body>
</html>
