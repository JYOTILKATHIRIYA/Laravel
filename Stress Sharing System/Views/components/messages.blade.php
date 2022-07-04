
      @foreach ($messages as $msg)
          
      <div  class="msg_con">

      @if ($msg->sender==$user)
        <span class="sended">{{$msg->message}}</span>

      @else
        <span class="recieved">{{$msg->message}}</span>

      @endif
    </div>

      @endforeach