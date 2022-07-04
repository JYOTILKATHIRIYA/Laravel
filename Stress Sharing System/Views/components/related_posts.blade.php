
@foreach ( App\Http\Controllers\posts::get_mentor_posts($mentorid) as $post)
    

<div class="post">

    
    <div class="post_creator">
      <div class="icon"><img src="img/profiles/p2.jpg" alt=""></div>
      <div class="info"><span>Name</span></div>
    </div>

    <div class="post_content">
      <pre>    
          {{App\Http\Controllers\posts::get_content($post->id)}}
    </pre>
      <div>
        <span>{{  App\Http\Controllers\posts::count_likes($post->id) }}</span>
      </div>
    </div>

    <div class="post_feedback">
      <div class="like">
      <button class="like_btn">Like</button>
    </div>
      <div class="comment">

      <input type="text" class="comment_box" />
      <input type="button" value="➤">
    </div>
    <textarea name="" id="" cols="30" rows="1"></textarea>
    </div>

  </div>

  @endforeach