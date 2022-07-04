<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="{{URL::asset('/css/mentor_issue_marking.css')}}">
  <link rel="stylesheet" href="{{URL::asset('/fontawesome/css/fontawesome.min.css')}}">
  <script src="{{URL::asset('/fontawesome/js/all.min.js')}}"></script>
</head>
<body>

  
  <div id="instruction">
    <h1>Please Upload your Profile Picture and select the fields in which you can guide our people best</h1>
    <span>Through this we can suggest you to the people who are in search of the mentors to help with their problems</span>
    
  </div>
 
  
  @if (count($errors->all())!=0)
<script>
  document.body.onload=()=>{
    if(window.history.replaceState){
      window.history.replaceState(null,null,"/");
    }
  }
    </script>
@endif
  <section id="issueMark-con">
    <div class="error_box">
      <span>@php
          if(count($errors)){
            echo ucwords( $errors->all()[0]);
          }
      @endphp</span>
          </div>

    <div id="issueMarkingForm">
      <form action="/register_mentor" enctype="multipart/form-data" method="POST">
        @csrf

        <div class="mentor_profilepic_upload">
       <span>Upload Profile Picture</span> <input type="file" name="mentor_profilepic" id=""accept="image/png, image/jpeg" />
      </div>

       
  
 <label class="issue_selection_lbl">Select Your Specializations</label>
      <x-checkbox_issue />
      <button><i class="fa-solid fa-circle-check"></i></button>

    </form>
    </div>

  
</section>
<footer>
  
</footer>
</body>
</html>