
<div class="menu">
    <div class="container-fluid">
        <div class="col-md-12 row row-header">
            <div class="col-md-2 row">
                <a class="logo" style="padding: 10px" href="{{URL::to('/')}}">
                    <img src="https://cfnapa.com/wp-content/uploads/2016/05/QA-Logo-Design-300.jpg" >
                </a>
            </div>
            <div class="col-md-8 form-search">
                <!--form action="#">
                    <label><input type="text"></label>
                    <i class="fa fa-search"></i>
                </form-->
            </div>
            <div class="col-md-2 col-login-reg">
                @if(!\Illuminate\Support\Facades\Auth::check())
                <ul class="ul-login-register" style="padding: 0;list-style: none; text-align: center">
                    <li><a href="{{route('login')}}">Đăng nhập</a></li>
                    <li><a href="{{route('register')}}">Đăng ký</a></li>
                </ul>
                @else
                    <div class="dropdown" style="width: 160px">
                        <button class="dropbtn" style="width: 100%">{{\Illuminate\Support\Facades\Auth::user()->name}}</button>
                        <div class="dropdown-content" style="text-align: center">
                            <a href="{{route('index.user',\Illuminate\Support\Facades\Auth::id())}}">Thông tin cá nhân</a>
                            <a href="{{route('logout')}}">Đăng xuất</a>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
