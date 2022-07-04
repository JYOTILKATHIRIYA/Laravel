<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/IssueMarking.css">
</head>
<body>


  <div id="instruction">
    <h1>Help Us match you to the right people</h1>
    <span>Please fill out this short questionnaire to provide anonymous background information about you and the issues you'd like 
      to deal with in life.It would help us match you with the most suitable persons for you.Your answers will also give us a 
      good starting point in getting to know you.</span>
  </div>
  
  <div id="issueMark-con">
    <div id="wrapper">
    <h1>Please mark all that apply</h1>

    <form action="/register" id="issueMarkingForm" method="POST">
      <div class="error_box">
        <span>@php
            if(count($errors)){
              echo ucwords( $errors->all()[0]);
            }
        @endphp</span>
            </div>
  
      @csrf

<x-checkbox_issue />
 
      <button>Done</button>
    </form>

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
    

  </div>
</body>
</html>