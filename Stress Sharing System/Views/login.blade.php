<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{URL::asset('css/SignUp.css')}}">
  <link rel="stylesheet" href="{{URL::asset('css/loginstyle.css')}}">
</head>
<body>
  <h1 style="color:green;
  text-align:center;
  font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  margin-top:25px;
  ">
  @if(isset($registration_message))
      {{$registration_message}}
  @endif</h1>
  <div id="SignUpContainer">

    <div id="reg_form_con" >

      <div id="reg_form_head">
        <label>Sign in</label>
      <span>Not a User? <a id="SignUpLink" href="#SignUp">Sign Up</a></span>

      </div>
      
      <form action="/authenticate" class="abc" method="POST">
        @csrf
        <div class="errorbox">
          <span>@php
            if(count($errors))
           echo $errors->all()[0];
          @endphp
          @if(isset($msg))
              {{$msg}}
          @endif
          </span>
        </div>
        <div class="forminputs">
        <input type="email" name="login_email" placeholder="Email Address">
        <input type="password" name="login_password" placeholder="Password">
        

       </div>
       
  <button class="createAC">Sign in</button>
      </form>
      
      <span style="display:block;padding:10px 20px;font-size:15px;font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;font-weight:200"><a href="/forgotpassword" style="text-decoration: none;color:lightyellow">Forgot Password??</a></span>
  
    </div>

   

  </div>
  
  
</body>
</html>