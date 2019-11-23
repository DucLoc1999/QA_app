<div class="menu">
    <div class="container-fluid">
        <div class="col-md-12 row">
                <div class="col-md-2 row">
                    <div class="logo">
                        <!--img src="https://image.shutterstock.com/image-vector/questions-answers-qa-speech-bubbles-260nw-405919432.jpg" -->
                        <img src="https://cfnapa.com/wp-content/uploads/2016/05/QA-Logo-Design-300.jpg" >
                    </div>
                </div>
            <div class="col-md-8 form-search">
                <!--form action="#">
                    <label><input type="text"></label>
                    <i class="fa fa-search"></i>
                </form-->
            </div>


                <div class="col-md-2 ">

                    @if(!Auth::check())
                    <button class="login-register btn btn-contact" href="#">Đăng nhập - Đăng ký</button>

                        @else
                            <a class="btn btn-danger" type="button" href="#">
                                {{Auth::user()->name}}                            </a>
                            <a class="btn btn-danger" type="button"
                               href="{{ route('logout') }}"                                        onclick="event.preventDefault();

                               document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                                >
                                logout
                            </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    @endif
                </div>

        </div>
    </div>
</div>
