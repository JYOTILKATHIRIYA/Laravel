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
      <link rel="stylesheet" href="{{URL::asset('css/feedback/admin_feedback.css')}}" />
    
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
               
               <!-- dashboard inner -->
               <div class="midde_cont" >
                 
                
                  <div class="white_shd full margin_bottom_30">
                     <div class="full graph_head">
                        <div class="heading1 margin_0">
                           <h2>Feedbacks</h2>
                        </div>
                     </div>
                     <div class="full progress_bar_inner">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="msg_list_main">
                                 <ul class="msg_list">

                                  @foreach (App\Http\Controllers\admin::get_feedbacks() as $feedback)
                                    <li style="position: relative">
                                       <span>
                                       <span class="msg_user">{{$feedback->email}}</span>
                                       <span class="name_user">{{$feedback->feedback}}</span>
                                       <span class="time_ago">{{$feedback->date}}</span>
                                       </span>
                                       <div style="position: absolute;bottom:10px;right:10px" class="feedback_btns">
                                        <input type="hidden" value={{$feedback->id}}>
                                       <button class="feedback_remove_btn">Remove</button>
                                      </div>
                                    </li>
                                    @endforeach
                                    
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               


               </div>
               <!-- end dashboard inner -->
            </div>


         </div><!-- end inner container-->

        
      </div> <!--end full container-->
      <script src="{{URL::asset('/js/Admin/MentorRequest.js')}}"></script>
     
   </body>
</html>