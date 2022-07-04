


@foreach ( App\Http\Controllers\chat::get_talkers_names() as $talker)
@php
$obj=App\Http\Controllers\chat::get_last_message($talker->id);

@endphp

<div class="element">
    <input type="hidden" value="{{$talker->id}}">
    <span>{{$talker->name}}</span>
    <span>@if ($obj->total_unreads)
        <label>{{$obj->total_unreads}}</label>
    @endif {{$obj->last_message}}</span>
 </div>

@endforeach

<script src="js/chatbox.js">
 
</script>


