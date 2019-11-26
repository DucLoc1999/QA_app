<?php
function format_time($time){
    $str = date_format(date_create($time)," H:i \\n j \\t n, Y");
    $str = str_replace('n', 'ngày', $str);
    $str = str_replace('t', 'tháng', $str);
    $str = str_replace('N', 'năm', $str);
    $str = str_replace('l', 'lúc', $str);
    return $str;
}
function short_format_time($time){
    $str = date_format(date_create($time)," H:i j/n/Y");
    $str = str_replace('n', 'ngày', $str);
    $str = str_replace('t', 'tháng', $str);
    $str = str_replace('N', 'năm', $str);
    $str = str_replace('l', 'lúc', $str);
    return $str;
}
?>
@extends('layout.head_new')
@section('title')
    Câu hỏi
@stop
@section('body')

    @include('layout.header_bar')
    <div class="body-qa">
        <div class="container-fluid">
            <div class="row">
                <div class="detail-state col-md-2">

                </div>
                <div class="list-question col-md-8">
                    <div class="main-content row">
                        <div class="col-md-10">
                            <h3>Câu hỏi: {{$question['content']}}</h3>
                            <p>Người hỏi: {{$users_names[$question['asker_id']]}}</p>
                            <p>Thời gian: {{format_time($question['created_at'])}}</p>
                        </div>
                        <div class="col-md-2 exit-room">
                            <a class="btn btn-danger" href="{{URL::to('/session/'.$question['session_id'])}}">
                                <i class="fas fa-door-open fa-2x"></i>
                            </a>
                        </div>

                    </div>
                    <div class="filter-question">

                        <div class="row down-amount">
                        <form class="row form-inline md-form form-sm" action="{{URL::to('/question/'.$question['id'])}}" method="GET" style="width: 100%; margin: 1px 0px 0px 0px">
                            <div class="col-md-7 offset-4 form filter_form">
                                <label>Xắp xếp theo: </label>
                                <select name="sort" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                    <option value="right"> Trả lời đúng </option>
                                    <option value="newest" {{(isset($request['sort']) && $request['sort'] == "newest") ? "selected" : ""}}> Mới nhất </option>
                                    <option value="oldest" {{(isset($request['sort']) && $request['sort'] == "oldest") ? "selected" : ""}}> Cũ nhất </option>
                                </select>

                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-light" type="submit" > Lọc </button>
                            </div>
                        </form>
                    </div>
                    </div>
                    <div class="list-box-question">
                        <?php
                        $i = 0;
                        $total_comment = 0;
                        ?>
                        @foreach($answers as $ans)
                            <?php
                                $i++;
                                $total_comment += count($comments[$ans['id']]);
                            ?>

                            <div id="answer_{{$ans['id']}}" class="box-question row {{$i%2!=0?"class-while":""}}">
                                    <div class="col-md-1 answer-space">

                                        @if($role == "session_creator")
                                            @if($ans['right_answer'] == 1)
                                                <i class="far fa-check-square fa-2x cursor-pointer" onclick="chose_answer({{$ans['id']}})"></i>
                                            @else
                                                <i class="far fa-square fa-2x cursor-pointer" onclick="chose_answer({{$ans['id']}})"></i>
                                            @endif
                                        @elseif($ans['right_answer'] == 1)
                                            <i class="far fa-check-square fa-2x"></i>
                                        @endif

                                    </div>
                                    <div class="col-md-10">
                                        <div class="col-md-9 answer">
                                        <div class="content-box" style="margin-left: -5px">
                                                <h6><b>{{$ans['content']}}</b></h6>
                                            </div>
                                        <div class="user-post row">
                                            <p>Người dùng: {{$users_names[$ans['user_id']]}}</p>
                                            <p>Thời gian: {{short_format_time($ans['created_at'])}}</p>
                                        </div>
                                        </div>
                                        @if(isset($comments[$ans['id']]))
                                            @foreach($comments[$ans['id']] as $com)
                                                <div class="col-md-12 comment">
                                                    <label>{{$com['content']}}</label>
                                                    <label class="info"> - từ: {{$users_names[$com['user_id']]}}, lúc: {{short_format_time($ans['created_at'])}}</label>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if($is_open)

                                        <form action="{{URL::to('/comment')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="answer_id" value="{{$ans['id']}}">
                                            <input type="hidden" name="session_id" value="{{$question['session_id']}}">
                                            <input name="content" class="col-md-12 comment-input" type="text" style="width: 96%" required>
                                            <i class="fas fa-paper-plane cursor-pointer" style="margin-left: 5px" onclick="this.parentElement.submit()"></i>
                                        </form>
                                        @endif
                                    </div>
                            </div>

                        @endforeach
                            <div class="box-question row" style="border: none">
                                <div class="col-md-1">

                                </div>
                                @if($is_open)
                                    <form class="col-md-10 add-answer" method="POST" action="{{URL::to('/answer')}}">
                                    <h6 style="margin-bottom: 10px">
                                        Thêm câu trả lời
                                    </h6>

                                    @csrf
                                    <input type="hidden" name="action" value="create">
                                    <input type="hidden" name="question_id" value="{{$question['id']}}">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <textarea id="content" class="form-control" name="content" style="height: 120px"placeholder="" required ></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-2 offset-md-10" style="text-align: right;">
                                            <button type="submit" class="btn btn-success">
                                                gửi
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                @endif
                            </div>

                    </div>
                </div>
                <div class="col-md-2 detail-state">
                    <div class="total-question" style="text-align: center">
                        <b>Số câu trả lời</b><br>
                        <strong>{{count($answers)}}</strong>
                    </div>
                    <div class="total-question" style="text-align: center">
                        <b>Số bình luận</b><br>
                        <strong>{{$total_comment}}</strong>
                    </div>
                </div>

            </div>
        </div>
    </div>


@stop
@section('script')

@if($role == "session_creator")
    <script>
        function chose_answer(ans_id) {
            var form = document.createElement("form");
            var i_token = document.createElement("input");
            var i_action = document.createElement("input");
            var i_question_id = document.createElement("input");
            var i_answer_id = document.createElement("input");
            var token = '@csrf'.substring(42);
            token = token.substring(0, token.length - 2);

            form.method = "POST";
            form.action = "{{URL::to('/answer')}}";
            i_token.name="_token";
            i_token.value= token;
            form.appendChild(i_token);

            i_action.name="action";
            i_action.value="chose_right";
            form.appendChild(i_action);

            i_question_id.name="question_id";
            i_question_id.value= "{{$question['id']}}";
            i_question_id.value= "{{$question['id']}}";
            form.appendChild(i_question_id);

            i_answer_id.name="answer_id";
            i_answer_id.value= ans_id;
            form.appendChild(i_answer_id);

            document.body.appendChild(form);

            form.submit();
        }
    </script>
@endif

@stop
