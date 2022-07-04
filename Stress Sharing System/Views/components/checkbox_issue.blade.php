

@foreach (App\Http\Controllers\register::get_issues() as $issue)
    
<div class="isuue-con">
    <input type="checkbox" name="{{$issue->name}}" />
    <label for="" style="text-transform: capitalize">
    
        
    {{
        str_replace("_"," ", Str::ucfirst(Str::lower($issue->name)) )}}
         
    </label>
</div>

@endforeach
