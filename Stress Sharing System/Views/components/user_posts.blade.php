
    


    

@foreach ( App\Http\Controllers\posts::get_user_related_posts() as $post)
    

    

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
          {{App\Http\Controllers\posts::get_content($post->post_id)}}
      </div>
      <div class="total_likes">
        <span>{{  App\Http\Controllers\posts::count_likes($post->post_id) }}</span>
      </div>
      <div class="total_comments">
        <i class="fa-regular fa-comment"></i> <span>{{  App\Http\Controllers\posts::count_comments($post->post_id) }}</span>
      </div>
    </div>

    
    <div class="post_feedback">
      <input type="hidden" value={{$post->post_id}}>
      <div class="like">

            @if (App\Http\Controllers\posts::is_liked($post->post_id))
      <button class="like_btn" class="liked">Liked</button>
            @else
      <button class="like_btn">Like</button>
            @endif            
      <button class="comment_btn"><i class="fa-regular fa-comment" style="color:green"></i>&nbsp;Comments</button>
      </div>
      <div class="comment">

    <textarea name="" id="" cols="30" rows="1" placeholder="Reply...." class="comment_box" ></textarea>
      
      <input type="button" value="➤">
    </div>
    </div>

  </div>
  
  @endforeach


  <script src="/js/posts.js"></script>
 