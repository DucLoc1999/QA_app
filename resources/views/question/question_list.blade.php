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
    Danh sách câu hỏi
@stop
@section('body')
    <body>
    @include('layout.header_bar')
    <div class="body-qa">
        <div class="container-fluid">
            <div class="row">
                <div class="ask-question col-md-2">
                    <div class="btn-ask-question row">
                        <button class="btn btn-danger">
                            <i style="margin-right: 5px" class="far fa-list-alt"></i> Khảo sát
                        </button>
                    </div>
                    <div class="btn-ask-question row">
                        <button class="btn btn-primary">
                            <i style="margin-right: 5px" class="far fa-plus-square"></i>Thêm câu hỏi</button>
                    </div>
                </div>
                <div class="list-question col-md-8">
                    <div class="filter-question">
                        <div class="row up-filter">
                            <h3>Danh sách câu hỏi</h3>
                        </div>
                        <div class="row down-amount">
                            <div class="col-md-4 form">
                                <form id="search_form" class="form-search" action="{{URL::to('/question')}}" action="GET" class="form-inline md-form form-sm" style="display: inline-block; width: 100%">
                                    <i class="fas fa-search" style="display: inline; margin-right: 10px"></i>
                                    <input name="search" class="form-control form-control-sm" style="width: 75%; height: 38px" type="text" placeholder="Tìm kiếm">

                                </form>

                            </div>
                            <div class="col-md-8 form">
                                <form id="filter_form" action="{{URL::to('/question')}}" action="GET" class="filter-dropdown" style="display: inline-block">
                                    <label>xắp xếp theo: </label>
                                    <select name="sort" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                        <option value="oldest"> Cũ nhất </option>
                                        <option value="newest" {{(isset($request['sort']) && $request['sort'] == "newest") ? "selected" : ""}}> Mới nhất </option>
                                    </select>
                                    <button class="btn btn-light" type="submit" > Lọc </button>
                                </form>

                            </div>
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
