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
    {{$session['topic']}}
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
                    <div class="col-md-4 featured-responsive">
                        <div class="detail-filter-text">
                            <p>34 Results For <span>Restaurant</span></p>
                        </div>
                    </div>
                    <div class="col-md-8 featured-responsive">
                        <div class="detail-filter">
                            <p>Filter by</p>
                            <form class="filter-dropdown">
                                <div class="md-form active-pink active-pink-2 mb-3 mt-0">
                                    <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                                </div>
                            </form>
                            <form class="filter-dropdown">
                                <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect1">
                                    <option selected>Restaurants</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </form>
                            <div class="map-responsive-wrap">
                                <a class="map-icon" href="#"><span class="icon-location-pin"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row detail-checkbox-wrap">
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">

                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">Bike Parking</span>
                        </label>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">Wireless Internet  </span>
                        </label>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">

                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">Smoking Allowed  </span>
                        </label>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">Street Parking</span>
                        </label>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">

                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">Special</span>
                        </label>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">Accepts Credit cards</span>
                        </label>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">

                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">Pets Friendly</span>
                        </label>

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
