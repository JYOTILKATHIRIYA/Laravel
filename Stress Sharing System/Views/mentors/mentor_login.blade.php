<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{URL::asset('/css/mentor_issue_marking.css')}}">
  <link rel="stylesheet" href="{{URL::asset('/fontawesome/css/fontawesome.min.css')}}">
  <script src="{{URL::asset('/fontawesome/js/all.min.js')}}"></script>
 
<style>
  body{
    margin: 0;
    background-image: url(css/img/dtl/blue-1024x919.jpg);
    background-size:cover;
  }
.mentor_login_form_con{
  width:100%;
height:100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;


}
.mentor_login_form_con form{
  width:30%;
  
}
.mentor_login_form_con form input{
  width: 100%;
  outline: none;
  box-shadow: 0 0 5px #525252;
  color: rgb(55, 55, 135);
  background-color: rgb(207, 225, 240);
  font-size: 1.1rem;
  border: 2px solid lightblue;
  border-radius: 10px;
  padding: 8px 18px;
  margin-top:5px;
  margin-bottom: 10px;
  font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;

}
.mentor_login_form_con form input:focus{
  border-color: rgb(55, 55, 135);
  transition:0.4s;
}
.mentor_login_form_con form span{
  display:block;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  font-size: 1.2rem;
  color:rgb(36, 35, 35);
}
.mentor_login_form_con form button {
  outline: none;
  width: 100%;
  padding: 12px 0;
  font-size: 1.02rem;
  font-family: Verdana, Geneva, Tahoma, sans-serif;
  background-color: rgb(184, 215, 226);
  background-color: rgb(157, 184, 218);
  box-shadow: 0px 2px 5px rgba(75, 75, 75);
  border-radius: 8px;
  margin-top:25px;
  cursor: pointer;
  border: none;

}

.mentor_login_form_con form button:hover {
  transition: 0.3s;
  box-shadow: 0px 2px 15px rgba(75, 75, 75);

}
 .mentor_login_form_con form .error_box {
text-align: center;
  padding: 20px 0;
  font-size: 1.5rem;
  font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}
.mentor_login_form_con form .error_box span{
  color:red;
}
a{
  text-decoration: none;
  color:rgb(36, 35, 35);
  font-weight: 500;
  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}
</style>
</head>

<body>


  <div class="mentor_login_form_con">
 
<div style="text-align: left">
  <span><a href="/MentorRegistration">Not Registered??</a></span>
</div>
  <form action="/MentorLogin" method="post">
    @csrf
    <div class="error_box">
      <span>
        @php
          if(count($errors)){
            echo ucwords( $errors->all()[0]);
          }
      @endphp</span>
          </div>
    <span>Email</span>
  <input type="email" name="mentor_email" value="{{old('mentor_email')}}">
  <span>Password</span>
  <input type="password" name="mentor_password" id="">
  <button>Login</button>
  </form>
</div>
</body>
</html>