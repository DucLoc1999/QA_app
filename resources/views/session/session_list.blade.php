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
@extends('layout.head_new')
@section('body')

@include('layout.header_bar')
   <div class="body-qa">
       <div class="container-fluid">
           <div class="row">
               <div class="detail-state col-md-2">
                   @if(isset($role) && $role == 'teacher')
                   <div class="btn-ask-question row">
                       <a class="btn btn-primary" href="{{URL::to('/session/create')}}">
                           <i style="margin-right: 5px" class="far fa-plus-square"></i>
                           Thêm phiên hỏi đáp
                       </a>
                   </div>
                   @endauth
               </div>
               <div class="list-question col-md-8">
                   <div class="filter-question">
                       <div class="row up-filter">
                               <h3>Danh sách phiên hỏi đáp</h3>
                       </div>
                       <div class="row down-amount">
                           <form class="row form-inline md-form form-sm" action="{{URL::to('/session')}}" method="GET" style="width: 100%; margin: 1px 0px 0px 0px">
                           <div class="col-md-4 form search-form">
                                   <i class="fas fa-search" style="display: inline; margin-right: 10px"></i>
                                   <input name="search" class="form-control form-control-sm" style="width: 75%; height: 38px" type="text" placeholder="Tìm kiếm">


                           </div>
                           <div class="col-md-7 form filter_form">
                                       <label>Trạng thái: </label>
                                       <select name="status" class="custom-select mb-2 mr-sm-2 mb-sm-0" >
                                           <option value="all" > Tất cả </option>
                                           <option value="open" {{(isset($request['status']) && $request['status'] == "open") ? "selected" : ""}} > Đang mở </option>
                                           <option value="close" {{(isset($request['status']) &&$request['status'] == "close") ? "selected" : ""}}> Đã đóng </option>
                                       </select>

                                       <label>Xắp xếp theo: </label>
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
                                       <p style="padding-top: 3px">{{format_time($ses['close_time'])}}</p>
                                   @else
                                       <p class="open-now"> ĐANG MỞ</p>
                                   @endif
                               </div>

                           </div>
                       </div>

                       @endforeach
                   </div>
               </div>
               <div class="col-md-2 detail-state">
                   <div class="total-question" style="text-align: center">
                       <b>Số phiên hỏi đáp</b><br>
                       <strong>{{count($sessions)}}</strong>
                   </div>
               </div>

           </div>
       </div>
   </div>



@stop

