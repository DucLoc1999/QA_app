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
                                    <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect">
                  <option selected>Best Match</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
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


                        @foreach($sessions as $ses)
                        <div class="col-sm-6 col-lg-12 col-xl-6 featured-responsive">
                            <div class="featured-place-wrap">
                                <a href="/session/{{$ses->session_id}}">
                                    <img src="{{$ses['img_url']}}" class="img-fluid" style="height: 300px" alt="#"><!--todo: thay hình ảnh-->
                                    <!--span class="featured-rating-orange ">6.5</span-->
                                    <div class="featured-title-box">
                                        <h6>{{$ses->topic}}</h6>
                                        <ul>
                                            <li>
                                                <p>Chủ tọa: {{$ses->auther}}</p>
                                            </li>
                                            <li>
                                                <p>Thời gian mở: {{format_time($ses->create_at)}}</p>
                                            </li>
                                            <li>
                                                <p>Số câu hỏi: {{$ses->quest_num}}</p>
                                            </li>

                                        </ul>
                                        <div class="bottom-icons">
                                            @if(!is_null($ses->close_at) && time() >= strtotime($ses->close_at))
                                                <div class="closed-now">CLOSED NOW</div>
                                                <span>{{format_time($ses->close_at)}}</span>
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


<form action="session" method="GET">
    @csrf
    <input type="text" name="search" value="">
    <input type="radio" name="soft" value="concerned">
    <input type="radio" name="soft" value="newest">
    <button type="submit"></button>
</form>


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
                <!--
                <div class="col-md-5 responsive-wrap map-wrap">
                    <div class="map-fix">
                        < data-toggle="affix"
                        < Google map will appear here! Edit the Latitude, Longitude and Zoom Level below using data-attr-*
                        <div id="map" data-lat="40.674" data-lon="-73.945" data-zoom="14"></div>
                    </div>
                </div>
                -->
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
        $(".map-icon").click(function() {
            $(".map-fix").toggle();
        });
    </script>
    <script>
        // Want to customize colors? go to snazzymaps.com
        /*function myMap() {
            var maplat = $('#map').data('lat');
            var maplon = $('#map').data('lon');
            var mapzoom = $('#map').data('zoom');
            // Styles a map in night mode.
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: maplat,
                    lng: maplon
                },
                zoom: mapzoom,
                scrollwheel: false
            });
            var marker = new google.maps.Marker({
                position: {
                    lat: maplat,
                    lng: maplon
                },
                map: map,
                title: 'We are here!'
            });
        }*/
    </script>
    <!-- Map JS (Please change the API key below. Read documentation for more info) -->
    <!--<script src="https://maps.googleapis.com/maps/api/js?callback=myMap&key=AIzaSyDMTUkJAmi1ahsx9uCGSgmcSmqDTBF9ygg"></script>-->
</body>

</html>
