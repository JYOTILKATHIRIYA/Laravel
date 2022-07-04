




<link rel="stylesheet" href="{{URL::asset('/fontawesome/css/fontawesome.min.css')}}">
<script src="{{URL::asset('/fontawesome/js/all.min.js')}}"></script>

       <div class="white_shd full margin_bottom_30">
          <div class="full graph_head">
             <div class="heading1 margin_0">
                <h2>Followed Mentors</h2>
             </div>
          </div>
          <div class="full progress_bar_inner">
             <div class="row">
                <div class="col-md-12">
                   <div class="msg_section">
                      <div class="msg_list_main">
                         <ul class="msg_list">

                            @foreach (App\Http\Controllers\mentors::get_followed_mentors() as $mentor)
                                
                            <li>
                                <div class="followed_mentors_comp">
                                    <div>
                                        <div class="profile_pic">
                                        <img src="profiles/{{$mentor->profile_pic}}" class="img-responsive" alt="#" />
                                        </div>
                                
                                    </div>

                                    <div style="text-align: left;width:100%;">
                                    <span class="name_user">{{$mentor->name}}</span>
                                    </div>
                              <input type="hidden" value="{{$mentor->mentorid}}">
                               <button class="unfollow_followed_btn">Unfollow</button>
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

    <style>
        
        .unfollow_followed_btn{
           color:lightblue;
            background-color: black;
            padding: 4px 10px;
            height:100%; 
            border-radius:5px; 
            border: none;
            max-height: 40px;
            box-shadow: 0 0 5px rgb(29, 29, 29);
        }
        .unfollow_followed_btn:hover{
         background-color: rgb(255,87,34);
    transition:background-color .15s ease-in-out;

        }
        .followed_mentors_comp{
            width: 100%;
            display: flex;
            font-size: 16px;
            justify-content: space-between;
            color:rgb(29, 29, 29);
            font-weight: 400;
            align-items: center
        }
        .followed_mentors_comp .profile_pic{
            width: 70px;
            height: 70px;
            border-radius:100%;
            overflow: hidden; 
            margin-right: 15px;
        }
        .followed_mentors_comp .profile_pic img{
            width: 100%;
            height: 100%;
        }
    </style>