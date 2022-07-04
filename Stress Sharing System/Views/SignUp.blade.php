<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{URL::asset('css/SignUp.css')}}">
</head>
<body>
  <div id="SignUpContainer">
  <div id="reg_form_con">

    <div id="reg_form_head">
      <label>Sign Up</label>
      <span>Existing user? <a id="SignInLink" href="#SignIn">Sign In</a></span>
    </div>
    <div class="labels">
      <h2>Welcome to our support community!</h2>
      <h2>Create your account in seconds to join the conversation.</h2>
      <h4>You must be aged 12-25, if below 13 you will need parental consent before creating an account.</h4>
      <h4>Please do not use your surname or post personal information.</h4>
    </div>
    <div class="errorbox">
      <span>@php
        if(count($errors))
       echo $errors->all()[0];
      @endphp
      {{$error}}</span>
    </div>
    <form action="/IssueMarking" method="POST">
      @csrf
      <div class="forminputs">
      <label for="DisplayName">Display Name</label>
      <input type="text" name="displayName" value="{{$displayName}}">
      <label for="email">Email Address</label>
      <input type="email" name="email" value="{{$email}}">
      <label for="password">Password</label>
      <input type="password" name="password" placeholder="Min 8 Max 12 with atleast one special character">
      <label for="ConfirmPassword">Confirm Password</label>
      <input type="password" name="password_confirmation" >
      <label for="CAPTCHA">{{$captcha_que}}</label>
      <input type="text" name="captcha">
      <input type="hidden" name="captcha_a" value={{$captcha_ans}}>
     

    </div>
<button class="createAC">Create my Account</button>
    </form>
  </div>
</div>
<script src="SignUp.js"></script>
</body>
</html>