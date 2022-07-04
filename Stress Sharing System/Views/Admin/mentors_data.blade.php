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
      <link rel="stylesheet" href="{{URL::asset('css/admin/MentorRequests.css')}}" />
      <link rel="stylesheet" href="{{URL::asset('css/admin/MentorData.css')}}" />
    
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->

      <link rel="stylesheet" href="{{URL::asset('/fontawesome/css/fontawesome.min.css')}}">
      <script src="{{URL::asset('/fontawesome/js/all.min.js')}}"></script>
    
      <style>
         .td_center{
            text-align: center;
            font-weight: 600;
         }
      </style>
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
               
               <!-- dashboard inner -->
               <div class="midde_cont" >
                 
                
                    <div class="white_shd full margin_bottom_30" >

                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Mentors</h2>
                                    <div id="search_bar"> 
                                       <input type="text" placeholder="Mentor Name"><button>Search</button>
                                    </div>
                                 </div>
                              </div>
                              
                              <div class="table_section padding_infor_info"  style="width: 100%;">
                                 <div class="table-responsive-sm" style="width: 100%;">
                                    <table class="table table-hover" style="width:100%;font-size:16px;" >
                                       <thead>
                                          <tr>
                                             <th>ID</th>
                                             <th>Name</th>
                                             <th>Email</th>
                                             <th>Profession</th>
                                             <th>Followers</th>
                                             <th>Posts</th>
                                             <th>From</th>
                                          </tr>
                                       </thead>
                                       <tbody id="table_body">
                                          @if (isset($issue))
                                          @php
                                              $mentor_data=App\Http\Controllers\admin::get_mentors_data($issue);
                                          @endphp
                                              @else
                                          @php
                                              $mentor_data=App\Http\Controllers\admin::get_mentors_data();
                                              @endphp

                                          @endif
                                        @foreach ($mentor_data as $mentor)
                                            
                                          <tr>
                                             <td>{{$mentor->mentorid}}</td>
                                             
                                             <td><a href='{{ url( "ADMIN/MentorProfile/$mentor->mentorid" ) }}'>{{$mentor->name}}</a></td>
                                             <td>{{$mentor->email}}</td>
                                             <td>{{$mentor->profession}}</td>
                                             <td class="td_center">{{$mentor->followers}}</td>
                                             <td class="td_center">{{$mentor->posts}}</td>
                                             <td >{{$mentor->year}}</td>
                                             
                                          </tr>
                                        @endforeach
                                          
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                     </div>
                        
               </div>
               <!-- end dashboard inner -->
            </div>


         </div><!-- end inner container-->

        
      </div> <!--end full container-->
     <script src="{{URL::asset('/js/admin/mentor_data.js')}}"></script>
   </body>
</html>