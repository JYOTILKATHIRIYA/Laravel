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
               <div class="midde_cont">


                <div class="container-fluid">
                  <div class="row column_title">
                     <div class="col-md-12">
                        <div class="page_title">
                          <h2>Mentor Requests</h2>
                        </div>
                     </div>
                  </div>
                  <!-- row -->
                  <div class="row column1">
                        <div class="white_shd full margin_bottom_30">
                         <div class="full graph_head">
                            <div class="heading1 margin_0">
                               <h2><a href="{{url('ADMIN/MentorRequests')}}">Pending</a>
                                <a class="requests_type" href="#">Approved</a>
                                <a href="{{url('ADMIN/MentorRequests/Rejected')}}">Rejected</a></h2>
                            </div>
                         </div>
                           <style>
                            .padding_infor_info{
                              background-color:lightblue; 
                            }
                            .padding_infor_info table{
                              background-color:white; 
                            }
                            .heading1 h2 a{
                               text-decoration: none;
                               margin-right: 20px
                            }
                            .requests_type  {
                               background-color: black;
                               color: cyan;
                               padding: 5px 10px;
                               border-radius: 5px;
                               border-top-right-radius: 5px;
                               box-shadow: 0 1px 5px rgb(41, 41, 41);
                            }
                           </style>
                           <div class="full price_table padding_infor_info">
                              <div class="row">
                                @if (count(App\Http\Controllers\admin::mentor_requests(1,0))==0)
                                    <h3>No Approved Requests</h3>
                                @else
                                 <div class="col-lg-12">
                                    <div class="table-responsive-sm">
                                       <table class="table table-striped projects">
                                          <thead class="thead-dark">
                                             <tr>
                                                <th>No</th>
                                                <th >Email</th>
                                                <th>CV</th>
                                                <th>Time</th>
                                                <th>Status</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                            @foreach (App\Http\Controllers\admin::mentor_requests(1,0) as $request)
                
                                             <tr>
                                                <td>1</td>
                                                <td class="req_email">
                                                   <a>{{$request->email}}</a>
                                                </td>
                                                <td class="align_center" class="cv">
                                                  <a href="/cvs/{{$request->cv}}"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                </td>
                                                <td class="req_time" class="align_center">
                                                   
                                                   <span style="text-align: center">{{$request->time}}
                                                   <label style="padding-left:15px;font-weight: 600">&nbsp;{{$request->date}}</label></span>
                                                </td>
                                                <td class="btns_con">
                                                  <input type="hidden" value="{{$request->email}}">
                                                   <button type="button"  class="undo_approved">Undo</button>
                                                </td>
                                             </tr>
                                             
                                             @endforeach
                                             
                
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                                 @endif
                
                              </div>
                           </div>
                        </div>
                     <!-- end row -->
                  </div>
                  
                </div>
                <script src="{{URL::asset('/js/Admin/MentorRequest.js')}}"></script>
                <script>
                  
                </script>
                               </div>
               <!-- end dashboard inner -->
            </div>


         </div><!-- end inner container-->

        
      </div> <!--end full container-->
     
   </body>
</html>