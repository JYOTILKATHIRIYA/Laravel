@if (count($result)==0)
    <h1 style="text-align: center">No Mentors Found!!</h1>
@else

@foreach ($result as $mentor)
<tr>
  <td>{{$mentor->mentorid}}</td>
  <td>{{$mentor->name}}</td>
  <td>{{$mentor->email}}</td>
  <td>{{$mentor->profession}}</td>
  <td class="td_center">{{$mentor->followers}}</td>
  <td class="td_center">{{$mentor->posts}}</td>
  <td>{{$mentor->year}}</td>
  
</tr>
@endforeach

@endif


