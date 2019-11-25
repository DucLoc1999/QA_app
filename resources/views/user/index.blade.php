<?php
function format_time($time){
    $str = date_format(date_create($time)," H:i \\n j, \\t n, Y");
    $str = str_replace('n', 'ngày', $str);
    $str = str_replace('t', 'tháng', $str);
    $str = str_replace('N', 'năm', $str);
    $str = str_replace('l', 'lúc', $str);
    return $str;
}
?>
@extends('layout.header_bar')
@section('content')
    <div class="container-fluid" style="padding-left: 40px">
        <div class="col-md-12 col-sm-12 row box-user">
            <div class="col-md-4 col-sm-4 profile-user">
                <ul class="info-user">
                    <li><i style="margin-right: 5px" class="far fa-user"></i> {{$user[0]->name}}</li>
                    <li><i style="margin-right: 5px" class="far fa-envelope"></i> {{$user[0]->email}}</li>
                    <li><i style="margin-right: 5px" class="far fa-question-circle"></i> Phiên hiện có: <span style="color: #ff8d22">{{$sessions->count()}}</span></li>
                </ul>
            </div>
            <div class="col-md-8 col-sm-8 list-session-user">
                <?php $i = 0;?>
                @foreach($sessions as $ses)
                    <?php $i++;?>

                    <div id="session_{{$ses['session_id']}}" class="box-question row {{$i%2!=0?"class-while":""}}">
                        <div class="col-md-12">
                            <a style="display: block;margin-left: -5px;" href="/session/{{$ses['session_id']}}" >
                                <div class="content-box">
                                    <strong>{{$ses['topic']}}</strong>
                                </div>
                            </a>
                            <div class="user-post row">
                                <img src="" alt="">
                                <p>Chủ tọa: {{$ses['auther']}}</p>
                                <p>Mở phiên lúc: {{format_time($ses['created_at'])}}</p>
                                <p>Số câu hỏi: {{$ses['quest_num']}}</p>
                            </div>
                            <div class="user-post row">
                                @if(!is_null($ses['close_time']) && time() >= strtotime($ses['close_time']))
                                    <p class="closed-now"> ĐÃ ĐÓNG</p>
                                    <p>{{format_time($ses['close_time'])}}</p>
                                @else
                                    <p class="open-now"> ĐANG MỞ</p>
                                @endif
                            </div>

                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
@stop
