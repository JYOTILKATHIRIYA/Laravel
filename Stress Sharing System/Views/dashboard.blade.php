<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{$userdata['displayname']}}</title>


  <link rel="stylesheet" href="{{URL::asset('css/admin/css/bootstrap.min.css')}}" />
<!-- site css -->
<link rel="stylesheet" href="{{URL::asset('css/admin/css/style.css')}}" />
<!-- responsive css -->
<link rel="stylesheet" href="{{URL::asset('css/admin/css/responsive.css')}}" />
<!-- color css -->
<!-- select bootstrap -->
<link rel="stylesheet" href="{{URL::asset('css/admin/css/bootstrap-select.css')}}" />
<!-- scrollbar css -->
<link rel="stylesheet" href="{{URL::asset('css/admin/css/perfect-scrollbar.css')}}" />
<!-- custom css -->
<link rel="stylesheet" href="{{URL::asset('css/admin/css/custom.css')}}" />
<link rel="stylesheet" href="{{URL::asset('css/admin/MentorRequests.css')}}" />

  <link rel="stylesheet" href="{{URL::asset('/css/dashboardstyle.css')}}">
  <link rel="stylesheet" href="{{URL::asset('/css/mentorprofilestyle.css')}}">
  <link rel="stylesheet" href="{{URL::asset('/fontawesome/css/fontawesome.min.css')}}">
  <script src="{{URL::asset('/fontawesome/js/all.min.js')}}"></script>


</head>

<body>

  <script>
      
  
  </script>

  <header id="dashboardheader">
    <div id="content_left">
      <span><i class="fa-solid fa-users"></i></span>
      <span><i class="fa-solid fa-user-check"></i></span>
    </div>

    <div id="content_right">
      <span class="message_icon">
        <span class="unreads"></span>
        <i class="fa-solid fa-message"></i>
      </span>


    <span><a><i class="fa-solid fa-user"></i><span>{{$userdata['displayname']}}</span></a></span>
   
    <div id="profile_popup">
      <button class="updateprofile_btn">Update Profile</button>
      <button class="signout_btn">Signout</button>
    </div>
  </div>
  </header>

      <!--Matching people-->

  <section id="matching_people_sec">
        <div id="matching_people_con">
    
       
@foreach ($matched_ids as $person)
<div class="matching_people_comp">
  <input type="hidden" name="mpid" value="{{$person->userid}}">
  <span>
       {{$person->displayname}}
     </span>
       <button>Start Chating</button>
  </div>
 
   
@endforeach

        </div>
    
      </section>

  


            <!--Followed Mentor-->
<section id="followed_mentors_sec">
<x-followed_mentor />
</section>


<!--chatbox-->      
      <section id="chatbox">
    
    
      </section>
 

      <!--Message Box-->
      <section id="message_box">
    <input type="hidden" value="">
        
        <div  class="back_button_con">
          <button><i class="fa-solid fa-arrow-left"></i></button>
      
        </div>

        <h1 name="talker_name" class="talker_name">
          
        </h1>

<div class="messages">

</div>

<div class="send_message_con">
  <textarea id="" placeholder="Write message here.." rows="1"></textarea>
  <button><i class="fa-solid fa-paper-plane"></i></button>
</div>

</section>


  <script src="js/chat.js"></script>

<div id="invisible">

  
  <section id="experts_suggession">
<x-experts_suggetion userid="{{$userdata['userid']}}"/>


  </section>

  <section id="posts_section">
<x-user_posts />

  </section>

<!--
  <section id="articals">

  </section>

  <section id="videos">

  </section>
  -->
</div>

<style>
 
</style>

<section id="mentor_profile_con">

  <div  class="back_button_con">
    <button><i class="fa-solid fa-arrow-left"></i></button>

  </div>

  <div  id="mentor_profile">

  </div>
</section>

<script src="{{URL::asset('js/dashboard.js')}}"></script>
<script id="chscript" src=""></script>

</body>
</html>