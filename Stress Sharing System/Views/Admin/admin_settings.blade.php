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
               <style>

               </style>
               <!-- dashboard inner -->
               <div class="midde_cont">
                 <div action=""  style="display: flex; flex-direction:column;align-items:center;justify-content:center;">
                 <h2 id="up_msg"></h2>
                  <table>
                    <tr>
                      <td> <label for="">Change Email: </label></td>
                      <td><input type="email" id="new_email"></td>
              </tr>
              <tr>
                 <td><label for="">Change Username : </label></td>
                 <td> <input type="text" id="new_username"></td>
                </tr>
                <tr>
                  <td><label for="">Change Password : </label></td>
                  <td> <input type="password" id="new_password"></td>
                 </tr>
                 <tr class="last_row">
                  <td><label for="">Enter Current Password : </label></td>
                  <td> <input type="password" id="curr_password"></td>
                 </tr>
                </table>
                 <button id="change_cred_btn">Change Credentials</button>
               </div>
               </div>
               <!-- end dashboard inner -->
            </div>


         </div><!-- end inner container-->

        
      </div> <!--end full container-->
      <script src="{{URL::asset('/js/Admin/admin.js')}}"></script>
     
      <style>
         td{
            padding: 10px;
         }
         #up_msg{

            padding: 18px 0;
         }
         label{
            font-size: 16px;
            color: rgb(45,45,45);
         }
         table{
            margin-top:15px; 
         }
         #change_cred_btn{
            padding: 5px 10px;
            background-color:rgb(45,45,45);
            color: lightblue;
            box-shadow: 0 0 5px gray;
            margin-top:10px;
            border-radius: 10px;
            cursor: pointer; 
         }
         input{
            font-size: 14px;
            padding: 8px 10px;
            border: 1px solid gray;
            outline: none;
            min-width: 250px;
         }
         .last_row td{
            padding-top:60px; 
         }
         .last_row td input{
            border-color: darkblue;
         }
      </style>
   </body>
</html>