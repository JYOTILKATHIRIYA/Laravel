
    

@foreach ( App\Http\Controllers\posts::get_mentor_profile_posts($mentorid) as $post)
    

    

<div class="post">

    
    <div class="post_creator">
      <div class="icon"><img src="{{URL::asset('/profiles')}}/{{$mentorpic}}" alt=""></div>
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

    <div class="post_feedback">
      <input type="hidden" value="{{$post->id}}">
      <div class="like">
      <button class="like_btn">Like</button>
      </div>
      <div class="comment">

    <textarea name="" id=""  placeholder="Reply...." cols="30" rows="1" class="comment_box" ></textarea>
      
      <input type="button" value="➤">
    </div>
    </div>

  </div>
  
  @endforeach
 