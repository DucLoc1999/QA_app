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
question list
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
                    <div class="col-md-2">
                        <div class="detail-filter-text">
                            <p>34 Results For <span>Restaurant</span></p>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="detail-filter">
                            <form action="question" action="GET" class="form-inline md-form form-sm active-cyan active-cyan-2 mt-2" style="display: inline-block">
                                <i class="fas fa-search"></i>
                                <input name="search" class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search"
                                       aria-label="Search">
                            </form>
                            <p>Filter by</p>
                            <form id="sort_form" action="question" action="GET" class="filter-dropdown">
                                <select name="soft" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect1" onchange="document.getElementById('sort_form').submit()">
                                    <option selected>Sắp xếp theo</option>
                                    <option value="concerned">Số bình luận</option>
                                    <option value="newest">Mới nhất</option>
                                </select>
                                <i class="fas fa-sort" onclick="document.getElementById('sort_form').submit()"></i>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row light-bg detail-options-wrap">


                    @foreach($questions as $quest)
                        <div class="col-sm-6 col-lg-12 col-xl-6 featured-responsive">
                            <div class="featured-place-wrap">
                                <a href="/question/{{$quest['quest_id']}}">
                                    <!--span class="featured-rating-orange ">6.5</span-->
                                    <div class="featured-title-box">
                                        <h6>{{$quest['content']}}</h6>
                                        <ul>
                                            <li>
                                                <p>người hỏi: {{$quest['asker']}}</p>
                                            </li>
                                            <li>
                                                <p>Thời gian hỏi: {{format_time($quest['create_at'])}}</p>
                                            </li>
                                            <li>
                                                <p>Số lời bình luận: {{$quest['total_comment']}}</p>
                                            </li>

                                        </ul>
                                        <div class="bottom-icons">
                                            @if($quest['right_answer'] == 1)
                                                <div class="closed-now">CLOSED NOW</div>
                                            @else
                                                <div class="open-now">OPEN NOW</div>
                                                <!--span class="ti-heart"></span>
                                                <span class="ti-bookmark"></span-->
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                @endforeach




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


<!-- Map JS (Please change the API key below. Read documentation for more info) -->
<!--<script src="https://maps.googleapis.com/maps/api/js?callback=myMap&key=AIzaSyDMTUkJAmi1ahsx9uCGSgmcSmqDTBF9ygg"></script>-->
</body>

</html>
