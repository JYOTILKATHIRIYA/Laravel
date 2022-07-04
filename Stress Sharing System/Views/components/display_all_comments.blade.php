
    


    

    

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
          {{App\Http\Controllers\posts::get_content($post->id)}}
      </div>
      <div class="total_likes">
        <span>{{  App\Http\Controllers\posts::count_likes($post->id) }}</span>
      </div>
      <div class="total_comments">
        <i class="fa-regular fa-comment"></i> <span>{{  App\Http\Controllers\posts::count_comments($post->id) }}</span>
      </div>
    </div>


    <div class="user_comments">

      @foreach ( App\Http\Controllers\posts::get_comments($post->id) as $comment)
      <div>
      <span class="commenter">
        {{$comment->displayname}}
      </span>
      <span class="comment">
        
        {{$comment->comment}}
      </span>
      
    </div>
      @endforeach

    </div>

  </div>
  

  <script src="/js/posts.js"></script>
 