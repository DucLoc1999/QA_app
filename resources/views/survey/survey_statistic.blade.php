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
    Thống kê khảo sát
@stop
@section('body')
    @include('layout.header_bar')
    <div class="body-qa">
        <div class="container-fluid">
            <div class="row">
                <div class="ask-question col-md-2">
                    <div class="btn-ask-question row" >
                        <a class="btn btn-info" href="{{URL::to('/session/'.$session['id'].'/survey')}}">
                            <i style="margin-right: 5px" class="far fa-list-alt"></i>
                            Khảo sát
                        </a>
                    </div>
                    <div class="btn-ask-question row">
                        <a class="btn btn-primary" href="{{URL::to('/survey/create?session_id='.$session['id'])}}">
                            <i style="margin-right: 5px" class="far fa-plus-square"></i>
                            Thêm khảo sát
                        </a>
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
                            <h3>Danh sách khảo sát</h3>
                        </div>
                        <div class="row down-amount">
                            <form class="row form-inline md-form form-sm" action="{{URL::to('/session/'.$session['id'].'/survey')}}" method="GET" style="width: 100%; margin: 1px 0px 0px 0px">
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
                            @foreach($surveys as $sur)
                                <?php $i++;?>

                                <div id="survey_{{$sur['id']}}"class="box-question row {{$i%2!=0?"class-while":""}}">
                                    <div class="col-md-12">
                                        <div class="content-box">
                                            <strong>{{$sur['content']}}</strong>
                                        </div>

                                        @foreach($sur_options[$sur['id']] as $so)
                                            <div class="row statistic">
                                            <label class="col-md-6" > {{$so['content']}} </label>
                                            <label class="col-md-3" >
                                                Số Lượt bình chọn: {{$so['total_vote']}}
                                            </label>
                                            <label class="col-md-2">
                                                Tỷ lệ: {{round(100*$so['total_vote']/$sur['total_vote'], 1)}} %
                                            </label><br>
                                            </div>
                                        @endforeach
                                        <div class="row statistic" style="border-bottom-style: solid ;border-color: goldenrod">
                                            <label class="col-md-6" ></label>
                                            <label class="col-md-5" >
                                                Tổng số bình chọn: {{$sur['total_vote']}}
                                            </label>
                                        </div>
                                        </div>
                                </div>

                            @endforeach
                            <div style="height: 100px; text-align: center; padding: 25px">
                                <button class="btn btn-success" style="display: inline-block;"> Gửi bình chọn</button>
                            </div>
                        </form>
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
