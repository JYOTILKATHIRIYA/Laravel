
@if (isset($message))

   <h1 style=" font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
   color: {{$color}};
   margin: 0;
   font-size: 22px;
   padding-top: 15px;">{{$message}}</h1>
@endif
<div class="post">

    
    <div class="post_creator">
      <div class="icon"><img src="{{URL::asset('/profiles')}}/{{$post->mentorpic}}" alt=""></div>
      <div class="info">
        <span>{{$post->name}}</span><br>
        <span>{{$post->date_time}}</span>
      </div>
    </div>


    <div class="post_content">
      <div class="content">  
        <textarea name="" id="updated_post" cols="30" rows="10">
          {{App\Http\Controllers\posts::get_content($post->id)}}
        </textarea>
      </div>
      <div class="total_likes">
        <span>{{  App\Http\Controllers\posts::count_likes($post->id) }}</span>
      </div>
      <div class="total_comments">
        <i class="fa-regular fa-comment"></i> <span>{{  App\Http\Controllers\posts::count_comments($post->id) }}</span>
      </div>
      
    </div>


    <div class="post_update_btn">
        <input type="hidden" value="{{$post->id}}">  

        <button>Update</button>
    </div>
   

  </div>
  

  <script src="/js/posts.js"></script>
 