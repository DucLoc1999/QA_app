<!DOCTYPE html>
<html lang="en">

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

@extends('layout.head')
@section('title')
    question num {{$question['id']}}
@stop
@section('css')
    .featured-responsive {
    max-width: 25%;
    }

@stop

<body>
<!--============================= HEADER =============================-->
@include('layout.header')

<!--//END HEADER -->
<!--============================= DETAIL =============================-->
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 responsive-wrap">
                <div class="row detail-filter-wrap">
                    <div class="col-md-6">
                        <div class="detail-filter-text">
                            <p>{{$question['total_comment']}} câu trả lời cho: <span>{{$question['content']}}</span></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-filter">
                            <form action="{{URL::to('/question/'.$question['id'])}}" action="GET" class="form-inline md-form form-sm active-cyan active-cyan-2 mt-2" style="display: inline-block">
                                <i class="fas fa-search"></i>
                                <input name="search" class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search"
                                       aria-label="Search">
                            </form>
                            <p>Filter by</p>
                            <form id="sort_form" action="{{URL::to('/question/'.$question['id'])}}" action="GET" class="filter-dropdown">
                                <select name="sort" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect1" onchange="document.getElementById('sort_form').submit()">
                                    <option selected>Sắp xếp theo</option>
                                    <option value="right">Câu trả lời đúng</option>
                                    <option value="newest">Mới nhất</option>
                                    <option value="oldest">Cũ nhất</option>
                                </select>
                                <i class="fas fa-sort" onclick="document.getElementById('sort_form').submit()"></i>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row light-bg detail-options-wrap">


                    @foreach($answers as $ans)
                        <div id="answer_{{$ans['id']}}" class="col-sm-6 col-lg-12 col-xl-6 featured-responsive">
                            <div class="featured-place-wrap">
                                <a>
                                    <!--span class="featured-rating-orange ">6.5</span-->
                                    <div class="featured-title-box">
                                        <h6>{{$ans['content']}}</h6>
                                            <div style="width: 100%; height:32px; display: block">
                                                @if($ans['right_answer'] == 1)
                                                    <label style="color: green"> Câu trả lời đúng </label>
                                                    <input style="position: absolute; top: 56px; right: 5px" type="checkbox" onclick="chose_answer({{$ans['id']}});" checked>
                                                @else
                                                    <input style="position: absolute; top: 56px; right: 5px" type="checkbox" onclick="chose_answer({{$ans['id']}});">
                                                @endif
                                            </div>
                                        <ul>
                                            <li>
                                                <p>người trả lời: {{$users_name[$ans['user_id']]}}</p>
                                            </li>
                                            <li>
                                                <p>Thời gian trả lời: {{format_time($ans['create_at'])}}</p>
                                            </li>
                                            <li>
                                                <p>Số lời bình luận: {{count($comments[$ans['id']]) }}</p>
                                            </li>

                                        </ul>
                                        <h6>Bình luận</h6>
                                        <ul>
                                            @foreach($comments[$ans['id']] as $com)
                                                <!--check is hidden-->
                                            <li>
                                                <p style="width: 25%;">{{$com['id'].': '.$users_name[$com['user_id']]}}: </p>
                                                <p style="width: 73%; display: inline-block; text-align: right;">{{$com['is_hidden'] == 1 ? "(đã bị ẩn)" : $com['content']}}</p>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </a>
                            </div>
                        </div>
                @endforeach

                <div class="col-sm-6 col-lg-12 col-xl-6 featured-responsive">
                    <h6>Tạo câu trả lời</h6>
                        <form method="POST" action="{{URL::to('/answer')}}" style="height: 100%; width: 100%">
                            @csrf
                            <input style="display: none" name="action" value="create">
                            <label>id câu hỏi: </label><input name="question_id" type="number" value="{{$question['id']}}"><br>
                            <label>id người dùng: </label><input name="user_id" type="number"><br>
                            <label>nội dung câu trả lời: </label><input name="content" type="text"><br>
                            <label>bị ẩn: </label><input name="is_hidden" type="number" value="0"}><br>
                            <button type="submit">gửi</button>

                        </form>
                </div>
                <div class="col-sm-6 col-lg-12 col-xl-6 featured-responsive">
                    <h6>Tạo bình luận</h6>
                    <form method="POST" action="{{URL::to('/comment')}}" style="height: 100%; width: 100%">
                        @csrf
                        <input style="display: none" name="question_id" value="{{$question['id']}}">
                        <label>id câu trả lời: </label><input name="answer_id" type="number"><br>
                        <label>id người dùng: </label><input name="user_id" type="number"><br>
                        <label>nội dung bình luận: </label><input name="content" type="text"><br>
                        <label>bị ẩn: </label><input name="is_hidden" type="number" value="0"}><br>
                        <button type="submit">gửi</button>

                    </form>
                </div>
                <div class="col-sm-6 col-lg-12 col-xl-6 featured-responsive">
                    <h6>chon câu đúng</h6>
                    <form method="POST" action="{{URL::to('/answer')}}" style="height: 100%; width: 100%">
                        @csrf
                        <input style="display: none" name="action" value="chose_right">
                        <input style="display: none" name="question_id" value="{{$question['id']}}">
                        <label>id người dùng: </label><input name="user_id" type="number"><br>
                        <label>id câu trả lời: </label><input name="answer_id" type="number"><br>
                        <button type="submit">gửi</button>

                    </form>
                </div>
                <!--

                                            <div class="col-sm-6 col-lg-12 col-xl-6 featured-responsive">
                                                <div class="featured-place-wrap">
                                                    <a href="detail.blade.php">
                                                        <img src="../images/featured4.jpg" class="img-fluid" alt="#">
                                                        <span class="featured-rating-green">9.5</span>
                                                        <div class="featured-title-box">
                                                            <h6>Pizza - Cicis</h6>
                                                            <p>Restaurant </p> <span>• </span>
                                                            <p>3 Reviews</p> <span> • </span>
                                                            <p><span>$$$</span>$$</p>
                                                            <ul>
                                                                <li><span class="icon-location-pin"></span>
                                                                    <p>1301 Avenue, Brooklyn, NY 11230</p>
                                                                </li>
                                                                <li><span class="icon-screen-smartphone"></span>
                                                                    <p>+44 20 7336 8898</p>
                                                                </li>
                                                                <li><span class="icon-link"></span>
                                                                    <p>https://burgerandlobster.com</p>
                                                                </li>

                                                            </ul>
                                                            <div class="bottom-icons">
                                                                <div class="closed-now">CLOSED NOW</div>
                                                                <span class="ti-heart"></span>
                                                                <span class="ti-bookmark"></span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>

                    -->                    </div>
            </div>
        </div>
    </div>
</section>
<!--//END DETAIL -->
<!--============================= FOOTER =============================-->
@include('layout.footer')
<!--//END FOOTER -->




<!-- jQuery, Bootstrap JS. -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<script>
    function chose_answer(ans_id) {
        var form = document.createElement("form");
        var i_token = document.createElement("input");
        var i_action = document.createElement("input");
        var i_question_id = document.createElement("input");
        var i_answer_id = document.createElement("input");
        var token = '@csrf'.substring(42);
        token = token.substring(0, token.length - 2);

        console.log(token);

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
        form.appendChild(i_question_id);

        i_answer_id.name="answer_id";
        i_answer_id.value= ans_id;
        form.appendChild(i_answer_id);

        document.body.appendChild(form);

        form.submit();
    }

</script>
<!-- Map JS (Please change the API key below. Read documentation for more info) -->
<!--<script src="https://maps.googleapis.com/maps/api/js?callback=myMap&key=AIzaSyDMTUkJAmi1ahsx9uCGSgmcSmqDTBF9ygg"></script>-->
</body>

</html>
