<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{URL::asset('css/mentor_request_form.css')}}">

  <title>Document</title>
</head>
<body>
  <div class="mentor_request_form_container">
    <div class="error_con">
      <span>
        @php
            if(count($errors)){
              echo $errors->all()[0];
            }
        @endphp
      </span>
    </div>
  <form action="/send_request" enctype="multipart/form-data" method="post">
   
    <div>
    @csrf
  Email : <input type="email" name="mentor_email" value="{{old('mentor_email')}}"/>
  Drop your CV/Resume here&nbsp; :  <input type="file" name="mentor_cv" accept="application/pdf"/><br><br>
  <label for="CAPTCHA" class="captcha_lable">{{$captcha_que}}</label>
<input type="text" name="captcha" class="captcha_input">
<input type="hidden" name="captcha_a" value="{{$captcha_ans}}">

</div>

  <div>
  <button>Request to Join</button>
  </div>

  </form>
</div>

</body>
</html>