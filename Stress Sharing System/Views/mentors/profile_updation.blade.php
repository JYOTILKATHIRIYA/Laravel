

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/profile_update.css">
    <title>Update Profile</title>
</head>
<body>
    <header>
        <span>Your Profile</span>
    </header>
    <div id="update_profile_form_con">

        
            @if (count($errors))
        <div class="error_box">

                {{ $errors->all()[0]}}
        </div>

            @endif

    <form action="/MentorProfileUpdate" method="POST">
@csrf
    <input type="hidden" value="{{$mentorid}}" name="mentorid">

        <table>
            <tr>
                <td>
                   <label for=""> Name : </label>
                </td>
                <td>
                    <input type="text" name="name" value="{{$name}}" >
                </td>
            </tr>

            <tr>
                <td>
                    <label for="">  Email: </label>
                </td>
                <td>
                    <input type="email" value="{{$email}}" name="email" >
                </td>
            </tr>

            <tr>
              <td>
                  <label for="">  Profession: </label>
              </td>
              <td>
                  <input type="text" value="{{$profession}}" name="profession" >
              </td>
          </tr>

          <tr>
            <td>
                <label for="">  Bio: </label>
            </td>
            <td>
                <textarea type="text" value="{{$bio}}" name="bio" rows="5">{{$bio}}</textarea>
            </td>
        </tr>

            <tr>
                <td>
                    <label for=""> Password : </label>
                </td>
                <td>
                    <input type="password" placeholder="New Password" style="margin-bottom: 10px" name="password">
                    <input type="password"  placeholder="Confirm Password" name="password_confirmation">
                </td>
            </tr>
           <tr class="issues_con">
            <td>
                <label for="">Change in the issues??</label>
            </td>
            <td >
              @foreach (App\Http\Controllers\profile_updation::get_mentor_issues($mentorid,1) as $issue)
              <div>
                  <input type="checkbox" checked style="display: inline;" name="{{$issue->id}}" id=""><span style="display: inline;">{{ucwords(str_replace("_"," ", strtolower($issue->issue)) ) }}</span>
              </div>
              @endforeach
              @foreach (App\Http\Controllers\profile_updation::get_mentor_issues($mentorid,0) as $issue)
              <div>
                  <input type="checkbox"  style="display: inline;" name="{{$issue->id}}" id=""><span style="display: inline;">{{ucwords(str_replace("_"," ", strtolower($issue->issue)) ) }}</span>
              </div>
              @endforeach
            </td>
           </tr>
        </table>

        <div class="buttons">
        <div class="back_btn">Go Back</div>
        <button class="update_button">Update</button>
    </div>
    </form>
    </div>

    <footer>
        
    </footer>
<script src="{{URL::asset('/js/mentors/mentor_profile_update.js')}}"></script>

</body>
</html>
