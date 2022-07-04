
<link rel="stylesheet" href="{{url::asset('css/dashboardstyle.css')}}">

@foreach ({{ App\Http\Controllers\dashboard::get_matches(4) }} as $userid)


@endforeach

@php
    Blade::include('includes.input', 'input');
@endphp
