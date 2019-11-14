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
    Danh sách phiên hỏi đáp
    @stop
@section('body')
<body>
@include('layout.header_bar')
   <div class="body-qa">
       <div class="container-fluid">
           <div class="row">
               <div class="ask-question col-md-2">
                   <div class="btn-ask-question row">
                       <button class="btn btn-primary"><i style="margin-right: 5px" class="fas fa-plus"></i>Thêm câu hỏi</button> 
                   </div>
                    <div class="btn-ask-question row">
                       <button class="btn btn-primary"><i style="margin-right: 5px" class="fas fa-plus"></i>Thêm khảo sát</button>
                   </div>
                   <div class="task-list row">
                       <ul>
                           <li><a href="#"><i class="fa fa-question-circle"></i> Question</a></li>
                            <!-- <li><a href="#"><i class="fa fa-tags"></i>  Tags</a></li>  -->
                            <li><a href="#"><i class="fa fa-trophy"></i> Badges</a></li> 
                            <!-- <li><a href="#"><i class="fa fa-th-list"></i> Categories</a></li> -->
                           <!-- <li><a href="#"><i class="fa fa-users"></i> Users</a></li> -->
                       </ul>
                   </div> 
               </div>
               <div class="list-question col-md-8">
                   <div class="filter-question">
                       <div class="row up-filter">
                           <div class="col-md-4">
                               <h3>Câu hỏi - Khảo sát</h3>
                           </div>
                           <div class="col-md-8 filter">
                               <div class="el-filter">
                                   <label> Lọc theo: </label>
                                   <form id="sort_form" action="question" action="GET" class="filter-dropdown" style="display: inline-block">
                                       <select name="soft" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect1" onchange="document.getElementById('sort_form').submit()">
                                           <option selected></option>
                                           <option value="concerned">Số bình luận</option>
                                           <option value="newest">Mới nhất</option>
                                       </select>
                                   </form>

                               </div>
                           </div>

                       </div>
                       <div class="row down-amount">
                           <div class="col-md-4 state-question-pre">
                               <ul class="state-question">
                                   <li><a href="#">Lịch sử</a></li>
                                   <li><a href="#">Votes</a></li>
                                   <li><a href="#">Đang mở</a></li>

                               </ul>
                           </div>
                       </div>
                   </div>
                   <div class="list-box-question">
                       <?php $i = 0;?>
                       @foreach($sessions as $ses)
                               <?php $i++;?>

                               <div class="box-question row {{$i%2!=0?"class-while":""}}">
                           <div class="col-md-12">
                               <a href="/session/{{$ses->session_id}}" >
                               <div class="content-box">
                                   <strong>{{$ses->topic}}</strong>
                               </div>
                               </a>
                               <div class="user-post row">
                                   <img src="" alt="">
                                   <p>Chủ tọa: {{$ses->auther}}</p>
                                   <p>Mở phiên lúc: {{format_time($ses->create_at)}}</p>
                                   <p>Số câu hỏi: {{$ses->quest_num}}</p>
                               </div>
                               <div class="user-post row">
                                   @if(!is_null($ses->close_at) && time() >= strtotime($ses->close_at))
                                       <p class="closed-now"> ĐÃ ĐÓNG</p>
                                       <p>{{format_time($ses->close_at)}}</p>
                                   @else
                                       <p class="open-now"> ĐANG MỞ</p>
                                   @endif
                               </div>

                           </div>
                           <!-- <div class="col-md-4 view-question">
                               <ul>
                                   <li>16 views</li>
                                   <li>2 answers</li>
                                   <li>0 votes</li>

                               </ul>
                           </div> -->
                       </div>

                       @endforeach
                   </div>
               </div>
               <div class="col-md-2 detail-state">
                   <div class="total-question">
                       <p>Câu hỏi</p>
                       <strong>18</strong>
                   </div>
                   <!-- <div class="total-member">
                       <p>Thành viên</p>
                       <strong>12</strong>
                   </div> -->
                  <!--  <div class="most-used-tags">
                       <p>MOST USED TAGS</p>
                       <ul>
                           <li><a href="#">business </a> x 6</li>
                           <li><a href="#">technology</a> x 5</li>
                           <li><a href="#">marketing</a> x 4</li>
                           <li><a href="#">google</a> x 8</li>
                           <li><a href="#">apps</a> x 1</li>
                           <li><a href="#">billionaire</a> x 10</li>
                           <li><a href="#">movie</a> x 5</li>
                       </ul>
                   </div> -->
                   <div class="hot-question">
                       <p>Quan tâm</p>
                       <ul>
                           <li>
                               <a href="#">
                                   <img src="" alt="">
                                   <p>What are the best mobile apps for traveling?</p></a>
                           </li>
                           <li>
                               <a href="#">
                                   <img src="" alt="">
                                   <p>Select coordinates which fall within a radius of a central point?</p></a>
                           </li>
                           <li>
                               <a href="#">
                                   <img src="" alt="">
                                   <p>How to become a billionaire in the next 5 years?</p>
                               </a>
                           </li>
                           <li>
                               <a href="#">
                                   <img src="" alt="">
                                   <p>How to be rich?</p>
                               </a>
                           </li>
                           <li>
                               <a href="#"><img src="" alt="">
                                   <p>What are the best mobile apps for traveling?</p></a>
                           </li>
                       </ul>
                   </div>


               </div>

           </div>
       </div>
   </div>
   <div class="bg-cover">
       <div class="display">

       </div>
       <div class="qa-login col-md-6">
           <div class="col-md-12 login"><!-- col-md-9 Begin -->
               <div class="row">
                   <div class="col-sm-6 img-login">
                       <img class="img-responsive" src="../img/signin-image.jpg"/></div>
                   <div class="col-sm-6">
                       <h2 id="signup">Sign In</h2>
                       <form method="post" action="#">
                           <div class="email">
                               <label><i class="fa fa-envelope"></i></label>
                               <input type="email" placeholder="Your Email" name="email-login" id="email-login" required>
                           </div>
                           <div class="password">
                               <label><i class="fa fa-lock"></i></label>
                               <input type="password" placeholder="Password" name="password-login" id="password-login" required>
                           </div>
                           <div class="remember">
                               <input type="checkbox" name="remember" id="remember"><label for="remember"><span>Remember me</span></label>
                           </div>
                           <input type="submit" value="Login">
                       </form>
                   </div>
               </div>
               <div class="link-to-register">
                   <a id="sign-up-here" href="#">Sign up here</a>
               </div>
           </div>
           <div class="col-md-12 register">
               <div class="link-to-login">
                   <a id="login-here" href="#"><i style="margin-right: 5px" class="fas fa-arrow-left"></i> Sign in</a>
               </div>
              <div class="row">
                  <div class="col-sm-6 register-form">
                      <h2 id="signup-register">Sign Up</h2>
                      <form action="#" method="post" enctype="multipart/form-data">
                          <div class="username">
                              <label><i class="fas fa-user"></i></label>
                              <input type="text" placeholder="Your Name" name="name" id="name">
                          </div>
                          <div class="email">
                              <label><i class="fa fa-envelope"></i></label>
                              <input type="email" placeholder="Your Email" name="email-register" id="email-register">
                          </div>
                          <div class="password">
                              <label><i class="fa fa-lock"></i></label>
                              <input type="password" placeholder="Password" name="password-register" id="password-register">
                          </div>
                          <div class="password">
                              <label><i class="fa fa-lock"></i></label>
                              <input type="password" placeholder="Re-password" name="repassword-register" id="repassword-register">
                          </div>
                          <input type="submit" value="Register">
                      </form>
                  </div>
                  <div class="col-sm-6 register-img">
                      <img class="img-responsive" src="../img/signup-image.jpg">
                  </div>
              </div>

           </div>
       </div>
   </div>


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
</body>
@stop

