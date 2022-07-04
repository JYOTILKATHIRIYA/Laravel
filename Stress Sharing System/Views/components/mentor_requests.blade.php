

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
               <h2><a class="requests_type" href="#">Pending</a>
                  <a href="{{url('ADMIN/MentorRequests/Approved')}}">Approved</a>
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
               color: yellow;
               padding: 5px 10px;
               border-radius: 5px;
               border-top-right-radius: 5px;
               box-shadow: 0 1px 5px rgb(41, 41, 41);
            }
           </style>
           <div class="full price_table padding_infor_info">
              <div class="row">
                @if (count(App\Http\Controllers\admin::mentor_requests())==0)
                    <h3>No New Requests</h3>
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
                            @foreach (App\Http\Controllers\admin::mentor_requests() as $request)

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
                                   <button type="button"  class="accept">Accept</button>
                                   <button type="button"  class="reject">Reject</button>
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
