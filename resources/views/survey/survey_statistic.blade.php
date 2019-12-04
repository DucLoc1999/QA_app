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
                <div class="detail-state col-md-2">
                    <div class="btn-ask-question row" >
                        <a class="btn btn-info" href="{{URL::to('/session/'.$session['id'].'/survey')}}">
                            <i style="margin-right: 5px" class="far fa-list-alt"></i>
                            Khảo sát
                        </a>
                    </div>
                    @if($is_open)
                    <div class="btn-ask-question row">
                        <a class="btn btn-primary" href="{{URL::to('/survey/create?session_id='.$session['id'])}}">
                            <i style="margin-right: 5px" class="far fa-plus-square"></i>
                            Thêm khảo sát
                        </a>
                    </div>
                    @endif
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
                            <h3>Thông kê khảo sát</h3>
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
                                                Tỷ lệ: {{$sur['total_vote'] != 0? round(100*$so['total_vote']/$sur['total_vote'], 1): 0}} %
                                            </label><br>
                                            </div>
                                        @endforeach
                                        <div class="row statistic" style="border-bottom-style: solid ;border-color: goldenrod">
                                            <label class="col-md-6" ></label>
                                            <strong class="col-md-5" style="padding-top: 5px">
                                                Tổng số bình chọn: {{$sur['total_vote']}}
                                            </strong>
                                        </div>
                                        </div>
                                </div>

                            @endforeach
                        </form>
                    </div>
                </div>
                <div class="col-md-2 detail-state">
                    <div class="total-question" style="text-align: center">
                        <b>Số khảo sát</b><br>
                        <strong>{{count($surveys)}}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>



@stop
