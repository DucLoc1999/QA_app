<?php
function format_time($time){
    $str = date_format(date_create($time)," H:i \\n j \\t n, Y");
    $str = str_replace('n', 'ngày', $str);
    $str = str_replace('t', 'tháng', $str);
    $str = str_replace('N', 'năm', $str);
    $str = str_replace('l', 'lúc', $str);
    return $str;
}
?>
@extends('layout.head_new')
@section('title')
    Phiên hỏi đáp
@stop
@section('body')
    <body>
    @include('layout.header_bar')
    <div class="body-qa">
        <div class="container-fluid">
            <div class="row">
                <div class="ask-question col-md-2">
                    <div class="btn-ask-question row">
                        <button class="btn btn-info">
                            <i style="margin-right: 5px" class="far fa-list-alt"></i> Khảo sát
                        </button>
                    </div>
                    <div class="btn-ask-question row">
                        <button class="btn btn-primary">
                            <i style="margin-right: 5px" class="far fa-plus-square"></i>Thêm câu hỏi</button>
                    </div>
                </div>
                <div class="list-question col-md-8">
                    <div class="main-content row">
                        <div class="col-md-10">
                            <h3>Phiên hỏi đáp: {{$session['topic']}}</h3>
                            <p>Chủ tọa: {{$creator_name}}</p>
                            <p>Thời gian: {{format_time($session['created_at'])}}</p>
                        </div>
                        <div class="col-md-2 exit-room">
                            <a class="btn btn-danger" href="{{URL::to('/session')}}">
                                <i class="fas fa-door-open fa-2x"></i>
                            </a>
                        </div>
                    </div>
                    <div class="filter-question">
                        <div class="row up-filter">
                            <h3>Danh sách câu hỏi</h3>
                        </div>
                        <div class="row down-amount">
                            <form class="row form-inline md-form form-sm" action="{{URL::to('/session/'.$session['id'])}}" method="GET" style="width: 100%; margin: 1px 0px 0px 0px">
                                <div class="col-md-4 form search-form">
                                    <i class="fas fa-search" style="display: inline; margin-right: 10px"></i>
                                    <input name="search" class="form-control form-control-sm" style="width: 75%; height: 38px" type="text" placeholder="Tìm kiếm">


                                </div>
                                <div class="col-md-7 form filter_form">
                                    <label>xắp xếp theo: </label>
                                    <select name="sort" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                        <option value="oldest"> Cũ nhất </option>
                                        <option value="newest" {{(isset($request['sort']) && $request['sort'] == "newest") ? "selected" : ""}}> Mới nhất </option>
                                    </select>

                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-light" type="submit" > Lọc </button>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="list-box-question">
                        <?php $i = 0;?>
                        @foreach($questions as $quest)
                            <?php $i++;?>

                            <div id="{{$quest['id']}}" class="box-question row {{$i%2!=0?"class-while":""}}">
                                <div class="col-md-12">
                                    <a href="{{URL::to('/question/'.$quest['quest_id'])}}" >
                                        <div class="content-box">
                                            <strong>{{$quest['content']}}</strong>
                                        </div>
                                    </a>
                                    <div class="user-post row">
                                        <img src="" alt="">
                                        <p>Người hỏi: {{$quest['asker']}}</p>
                                        <p>Thời gian: {{format_time($quest['created_at'])}}</p>
                                        <p>Số lời trả lời và bình luận: {{$quest['total_comment']}}</p>
                                    </div>
                                    <div class="user-post row">
                                        <p class="question"> CÂU HỎI </p>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
                <div class="col-md-2 detail-state">
                    <div class="total-question" style="text-align: center">
                        <b>Số lượng câu hỏi</b><br>
                        <strong>{{count($questions)}}</strong>
                    </div>
                </div>

            </div>
        </div>
    </div>


    </body>
@stop

@section('script')
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
@endsection
