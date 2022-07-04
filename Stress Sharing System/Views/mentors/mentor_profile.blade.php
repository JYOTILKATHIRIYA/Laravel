<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{URL::asset('/css/mentorprofilestyle.css')}}">
  <script src="https://kit.fontawesome.com/f256d0a972.js" crossorigin="anonymous"></script>

</head>

<body>
  <section id="profile_section">

    <div class="profile_con">
<input type="hidden" value="{{$mentor->mentorid}}">

      <div class="profile_picture">
        <img src="/profiles/{{$mentor->profile_pic}}" alt="">
      </div>

      <div class="profile_info">
        <h1 class="name">{{$mentor->name}}</h1>
        <span class="profession">{{$mentor->profession}}</span>
        <span class="bio">{{$mentor->bio}}</span>
        <span class="email">{{$mentor->email}}</span>

        <div class="followers">
          <span><i class="fa-solid fa-wifi" style="transform: rotate(35deg)"></i>&nbsp;Followed By  {{App\Http\Controllers\mentors::count_followers($mentor->mentorid)}}</span>
          @if (App\Http\Controllers\mentors::is_follower($mentor->mentorid))
          <button class="following"><i class="fa-solid fa-check"></i>&nbspFollowing</button>
                  
              @else
          <button class="follow">Follow</button>
                  
          @endif
        </div>
        
      </div>


    </div>


  </section>

  <section id="posts_section">
    
    <x-mentor_posts mentorid="{{$mentor->mentorid}}" mentorpic="{{$mentor->profile_pic}}"/>

  </section>

  <script src="{{URL::asset('/js/mentors/dashboard.js')}}"></script>
  <script src="{{URL::asset('/js/posts.js')}}"></script>

  
</body>

</html>