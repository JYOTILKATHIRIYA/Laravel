<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{$mentor->name}}</title>
  <link rel="stylesheet" href="{{URL::asset('/css/mentorprofilestyle.css')}}">
  <link rel="stylesheet" href="{{URL::asset('/css/mentor/dashboardstyle.css')}}">
  <link rel="stylesheet" href="{{URL::asset('/fontawesome/css/fontawesome.min.css')}}">
  <link rel="stylesheet" href="{{URL::asset('/fontawesome/css/solid.min.css')}}">

  <script src="{{URL::asset('/fontawesome/js/all.min.js')}}"></script>


</head>

<body>
  <header id="dashboardheader">

    <div>
   <span>  <a href="#profile_section"><i class="fa-solid fa-user-large"></i>&nbsp;{{$mentor->name}}</a></span>
    </div>
    <div>
      <span class="mentor_update_profile_btn"><i class="fa-solid fa-user-pen"></i>&nbsp;Update Profile</span>

      <span class="mentor_signout_btn"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;SignOut</span>
  </div>

  </header>

  <section id="profile_section">

    <div class="profile_con">


      <div class="profile_picture">
        <span class="edit_profile_picture_btn"><input type="hidden" value="{{$mentor->email}}"><i class="fa-solid fa-upload"></i></span>
        <img src="{{URL::asset('/profiles')}}/{{$mentor->profile_pic}}" alt="">
      </div>

      <div class="profile_info">
        <h1 class="name">{{$mentor->name}}</h1>
        <span class="profession">{{$mentor->profession}}</span>
        <span class="bio">{{$mentor->bio}}</span>
        <span class="email">{{$mentor->email}}</span>
        <div class="followers">
        <span><i class="fa-solid fa-wifi" style="transform: rotate(35deg)"></i>&nbsp;Followed By  {{App\Http\Controllers\mentors::count_followers($mentor->mentorid)}}</span>
      </div>
      </div>

    </div>


  </section>

  <section id="create_post_section">

      <div class="container">

              <div>
                <span>Create new post.....</span>
               <textarea name="" id=""  rows="2" cols="30" ></textarea>
               </div>

              <div>
                <button >Post</button>
              </div>

      </div>

      
  </section>

  <section id="posts_section">
    
    <x-mentor_dashboard_posts mentorid="{{$mentor->mentorid}}" mentorpic="{{$mentor->profile_pic}}"/>

  </section>

  <section id="post_updation">
  
  </section>

<div id="delete_popup_con">
  <div id="delete_popup">
    <span>Are you sure ??</span>
    <span> Do you really want to delete this post??</span>
<div class="buttons">
  <button style="background-color: gray">Cancle</button>
  <button style="background-color: red">Delete</button>
</div>
  </div>
</div>

  
<section id="absolute_section">

  <div  class="back_button_con">
    <button><i class="fa-solid fa-arrow-left"></i></button>

  </div>

  <div  id="absolute_container">

  </div>
</section>

<script src="{{URL::asset('/js/mentors/dashboard.js')}}"></script>

</body>

</html>