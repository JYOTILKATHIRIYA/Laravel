
    @foreach (App\Http\Controllers\dashboard::mentor_suggetions($userid) as $mentor)

<div class="expert_profile">
    
        
    <div class="profile_pic">
<img src="/profiles/{{$mentor->profile_pic}}" alt="">
    </div>
    <div class="profile_info">
<a href="#"  name="{{$mentor->mentorid}}"><span>{{$mentor->name}}</span></a>
<span class="profession">{{$mentor->profession}}</span>

    </div>
    <button>+Follow</button>


  </div>
  @endforeach
