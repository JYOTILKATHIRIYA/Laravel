


@foreach ( App\Http\Controllers\posts::get_mentor_posts($last_only) as $post)



<div class="post">
<input type="hidden" name="" value="{{$post->id}}">

<div class="post_creator">
  <div class="icon"><img src="{{URL::asset('/profiles')}}/{{$post->mentorpic}}" alt=""></div>
  <div class="info">
    <span>{{$post->name}}</span><br>
    <span>{{$post->date_time}}</span>
  </div>
</div>

<div class="post_content">

  <div class="buttons">
     <button><i class="fa-solid fa-pen-to-square"></i></button>
     <button><i class="fa-solid fa-trash"></i></button>
  </div>

  <div class="content">    
      {{App\Http\Controllers\posts::get_content($post->id)}}
  </div>
  
  <div>
    <span>{{  App\Http\Controllers\posts::count_likes($post->id) }}</span>
  </div>

</div>

<div class="post_feedback">
    

   <div class="comment">
    <script>

    </script>
<textarea name="" id="" cols="30" rows="1" class="comment_box" ></textarea>
  
  <input type="button" value="➤">

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

</div>

@endforeach

