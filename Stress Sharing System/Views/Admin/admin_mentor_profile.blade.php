
<!--
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://kit.fontawesome.com/f256d0a972.js" crossorigin="anonymous"></script>

</head>

<body>

  
</body>

</html>
-->


<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>ADMIN</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="stylesheet" href="{{URL::asset('css/admin/css/bootstrap.min.css')}}" />
      <!-- site css -->
      <link rel="stylesheet" href="{{URL::asset('css/admin/css/style.css')}}" />
      <!-- responsive css -->
      <link rel="stylesheet" href="{{URL::asset('css/admin/css/responsive.css')}}" />
      <!-- color css -->
      <link rel="stylesheet" href="{{URL::asset('css/admin/css/colors.css')}}" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="{{URL::asset('css/admin/css/bootstrap-select.css')}}" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="{{URL::asset('css/admin/css/perfect-scrollbar.css')}}" />
      <!-- custom css -->
      <link rel="stylesheet" href="{{URL::asset('css/admin/css/custom.css')}}" />
  <link rel="stylesheet" href="{{URL::asset('/css/admin/mentorprofile_admin.css')}}">

    
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

      <link rel="stylesheet" href="{{URL::asset('/fontawesome/css/fontawesome.min.css')}}">
      <script src="{{URL::asset('/fontawesome/js/all.min.js')}}"></script>
    
   </head>
   <body class="dashboard dashboard_1">
      <div class="full_container">

         <div class="inner_container">



            <!-- Sidebar  -->
            <x-admin_sidebar />
            <!-- end sidebar -->



            <!-- right content -->
            <div id="content">

               <!-- topbar -->
                   <x-admin_topbar />
               <!-- end topbar -->
               <style>

               </style>
               <!-- dashboard inner -->
               <div class="midde_cont">
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
                        
                      </div>
                      
                    </div>
              
              
                  </div>
              
              
                </section>
              
                <section id="posts_section">
                  
                  <x-mentor_posts mentorid="{{$mentor->mentorid}}" mentorpic="{{$mentor->profile_pic}}"/>
              
                </section>
              
                <script src="{{URL::asset('/js/mentors/dashboard.js')}}"></script>
                <script src="{{URL::asset('/js/posts.js')}}"></script>
              
              </div>
               <!-- end dashboard inner -->
            </div>


         </div><!-- end inner container-->

        
      </div> <!--end full container-->
     
   </body>
</html>