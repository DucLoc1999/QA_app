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
Danh sách khảo sát
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
                        <i style="margin-right: 5px" class="far fa-question-circle"></i> Câu hỏi</button>
                </div>
                <div class="btn-ask-question row">
                    <button class="btn btn-primary">
                        <i style="margin-right: 5px" class="far fa-plus-square"></i>Thêm khảo sát</button>
                </div>
            </div>
            <div class="list-question col-md-8">
                <div class="filter-question">
                    <div class="row up-filter">
                        <h3>Danh sách khảo sát</h3>
                    </div>
                    <div class="row down-amount">
                        <div class="col-md-4 form">
                            <form id="search_form" class="form-search form-inline md-form form-sm" action="{{URL::to('/question')}}" action="GET" style="display: inline-block; width: 100%">
                                <i class="fas fa-search" style="display: inline; margin-right: 10px"></i>
                                <input type="hidden" name="type" value="{{isset($surveys)? 'survey' : 'quest'}}">
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
                @foreach($surveys as $sur)
                <?php $i++;?>

                <div id="survey_{{$sur['id']}}"class="box-question row {{$i%2!=0?"class-while":""}}">
                <div class="col-md-12">
                        <div class="content-box">
                            <strong>{{$sur['content']}}</strong>
                        </div>
                    <!--div class="user-post row">
                        <img src="" alt="">
                        <p>Người tạo: {{$sur['user_id']}}</p>
                        <p>Thời gian: {{format_time($sur['created_at'])}}</p>
                    </div-->
                    <form action="{{URL::to('/survey')}}" method="POST">
                        @csrf
                        <input type="hidden" name="action" value="vote">
                        <input type="hidden" name="survey_id" value="{{$sur['id']}}">
                    @foreach($sur_options[$sur['id']] as $so)
                            <input class="custom-radio" type="radio" name="vote" value="{{$so['option_num']}}}" {{$user_votes[$sur['id']]['vote'] == $so['option_num'] ? 'checked':''}}><label> {{$so['content']}} </label><br>
                    @endforeach
                        <button class="btn btn-success" style="display: inline-block; float: right"> Gửi bình chọn</button>
                    </form>
                    <!--div class="user-post row">
                        <p class="survey"> KHẢO SÁT </p>
                        @if($sur_open)
                            <p class="open-now"> ĐANG MỞ</p>
                        @else
                            <p class="closed-now"> ĐÃ ĐÓNG</p>
                        @endif
                    </div-->
                </div>
            </div>

            @endforeach

        </div>
    </div>
    <div class="col-md-2 detail-state">
        <div class="total-question" style="text-align: center">
            <b>Số lượng khảo sát</b><br>
            <strong>{{count($surveys)}}</strong>
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
