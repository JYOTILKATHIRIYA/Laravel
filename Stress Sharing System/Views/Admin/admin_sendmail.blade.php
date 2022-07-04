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
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- site icon -->
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
      <!-- select bootstrap -->
      <link rel="stylesheet" href="{{URL::asset('css/admin/css/bootstrap-select.css')}}" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="{{URL::asset('css/admin/css/perfect-scrollbar.css')}}" />
      <!-- custom css -->
      <link rel="stylesheet" href="{{URL::asset('css/admin/css/custom.css')}}" />
      <link rel="stylesheet" href="{{URL::asset('css/admin/MentorRequests.css')}}" />
    
      <link rel="stylesheet" href="{{URL::asset('/fontawesome/css/fontawesome.min.css')}}">
      <script src="{{URL::asset('/fontawesome/js/all.min.js')}}"></script>
    
    </head>
   <body class="inner_page email_page">
      <div class="full_container">
         <div class="inner_container">
            <x-admin_sidebar />
            
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
                              <h2>Email Page</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row">
                        <!-- table section -->
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Email Box</h2>
                                 </div>
                              </div>
                              <div class="full inbox_inner_section">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="full padding_infor_info">
                                          <div class="mail-box">
                                             <aside class="sm-side">
                                                <div class="user-head">
                                                   
                                                   <div class="user-name">
                                                      <h5><a href="#">ADMIN</a></h5>
                                                      <span ><a href="#">{{$admin->email}}</a></span>
                                                   </div>
                                                </div>
                                                
                                                <ul class="nav nav-pills nav-stacked labels-category inbox-divider">
                                                   <li>
                                                      <h4>Recievers</h4>
                                                   </li>
                                                   <li><input type="checkbox" class="checked_user" ><span style="padding-left: 5px;font-weight:500;"> Users</span></li>
                                                   <li><input type="checkbox" class="checked_mentor" ><span style="padding-left: 5px;font-weight:500;"> Mentors</span></li>
                                                   
                                                </ul>
            
                                             </aside>
                                             <aside class="lg-side" style="padding:5px 10px;">
                                                <div id="mail_box">
                                               <textarea class="send_mail_txt" name="" id="" cols="30" rows="10"></textarea>
                                               <button class="send_mail_btn">Send Mails</button>
                                             </div>
                                             </aside>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- table section -->
                     </div>
                  </div>
                  <!-- footer -->
                  <style>
                     #mail_box{
                        width: 100%;
                        height: 100%;
                        
                     }
                     #mail_box textarea{
                        width: 100%;
                        height: 100%;
                        resize: none;
                        padding: 20px;
                        font-size: 17px;
                     }
                     #mail_box button{
                        background: #1ed085;
                        color: #fff;
                      
                        text-align: center;
                        cursor: pointer;
                        border:none;
                        width: 30%;
                        font-size: 16px;
                        font-weight: 500;
                      
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
   border-radius:0.25rem; 
    user-select: none;
    border: 1px solid transparent;
    padding: 15px 0.75rem;
   
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
         
                     }
                     #mail_box button:hover{
                        display: inline-block;
                        background-color: rgb(255,87,34);
              }
                  </style>
               </div>
               <!-- end dashboard inner -->
            </div>
         </div>
         <!-- model popup -->
      </div>
     
      <script src="{{URL::asset('/js/Admin/MentorRequest.js')}}"></script>
      
    </body>
</html>