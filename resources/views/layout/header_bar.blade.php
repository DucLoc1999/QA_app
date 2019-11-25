
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
