<nav id="sidebar">
    <div class="sidebar_blog_1">
       <div class="sidebar-header">
          
       </div>
       <div class="sidebar_user_info">
          <div class="icon_setting"></div>
          <div class="user_profle_side">
             <div class="user_info">
                <h6>ADMIN</h6>
             </div>
          </div>
       </div>
    </div>
    <div class="sidebar_blog_2">
       
       <ul class="list-unstyled components">
          <li class="active">
             <a href="{{url('/adminpanel')}}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-dashboard yellow_color"></i> <span>Dashboard</span></a>
             
          </li>
          <li><a href="{{url('ADMIN/MentorRequests')}}" ><i class="fa-solid fa-envelope-open-text yellow_color"></i> <span>Mentor Requests</span></a></li>
          <li><a href="{{url('ADMIN/Feedbacks')}}"><i class="fa-solid fa-envelope-open yellow_color"></i> <span>Feedbacks</span></a></li>
          <li><a href="{{url('ADMIN/Settings')}}"><i class="fa fa-cog yellow_color"></i> <span>Settings</span></a></li>
          <li><a href="{{url('ADMIN/SendMails')}}"><i class="fa-solid fa-share-from-square yellow_color"></i> <span>Send Mails</span></a></li>
       </ul>

    </div>
 </nav>