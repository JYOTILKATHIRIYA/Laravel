<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{URL::asset('/css/mentor_registration.css')}}">

</head>

<body>
  <div id="instruction">
    <h1>Please fill out this short questionnaire to provide background information about you.</h1>
  </div>

  <div class="form_con">
    @if (count($errors))
    <div class="error_box">
      <span>
        
          {{ ucwords( $errors->all()[0]); }}
      
    </span>
        </div>
    @endif

    
    <form action="/validate_mentor" method="POST">
@csrf
      <table>
        <tr>
          <td>Name : </td>
          <td><input type="text" name="mentor_name" value="{{old('mentor_name')}}"></td>
        </tr>
        <tr>
          <td>Email : </td>
          <td><input type="email" name="mentor_email" value="{{old('mentor_email')}}"></td>
        </tr>
        <tr>
          <td>Profession : </td>
          <td><input type="text" name="mentor_profession" value="{{old('mentor_profession')}}"></td>
        </tr>
        <tr>
          <td>Bio : </td>
          <td><textarea name="mentor_bio" rows="4" cols="20" value="{{old('mentor_bio')}}">{{old('mentor_bio')}}</textarea></td>
        </tr>

        <!--
        <tr>
          <td>Profile Picture : </td>
          <td><input type="file" name="mentor_profilepic" id=""></td>
        </tr>
        --->
        <tr>
          <td>Create Password : </td>
          <td><input type="password" name="mentor_password" placeholder="Min 8 Max 12 one special character"></td>
        </tr>
        <tr>
          <td>Confirm Password : </td>
          <td><input type="password" name="mentor_password_confirm"></td>
        </tr>
      </table>
      <button>Register</button>
    </form>
    <script src="{{URL::asset('/js/mentor_registration.js')}}"></script>
  </div>
  <footer>
    
  </footer>
</body>

</html>