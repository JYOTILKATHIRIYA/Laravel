<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class login extends Controller
{
  //
  public function login_form()
  {
    return view("login");
  }



  public function get_user(Request $userdata)
  {
    $userdata->validate(
      [
        "login_email" => "required|email",
        "login_password" => "required"
      ]
    );
    $user_exist = DB::select(sprintf("SELECT count(email) as result from users where email ='%s'", $userdata['login_email']));
    if ($user_exist[0]->result) {
      $pass = DB::select(sprintf("SELECT password  from users where email ='%s'", $userdata['login_email']));

      //echo $pass[0]->password."  ".$userdata['login_password'];

      if ($pass[0]->password == $userdata['login_password']) {

        $user_info = DB::select(sprintf("SELECT userid,displayname,email,match_string from users where email='%s'", $userdata['login_email']));
        $user = $user_info[0];
        //session_start();
        $_SESSION['logged_user'] = $user;

        return redirect("/DashBoard");
        //print_r($user);

      }

      $validator = array("login_password" => "Wrong password entered");
      return redirect('/')
        ->withErrors($validator)
        ->withInput();
    }

    $validator = array("login_email" => " not registered... Please Sign Up");
    return redirect('/')
      ->withErrors($validator)
      ->withInput();
  }

  public function display_dashboard()
  {

    //session_start();
    if (isset($_SESSION['logged_user'])) {
      $userdata = (array)$_SESSION['logged_user'];

      $r = DB::select('select match_string from users where userid = ?', [$userdata['userid']]);
      $issues_array=json_decode($r[0]->match_string);
      $matched_people=array();

      $query=sprintf("SELECT userid from user_issues where not userid=%d and (issueid=%d",$userdata['userid'],$issues_array[0]);

      for($i=1;$i<count($issues_array);$i++){
          $query.=" OR issueid=".$issues_array[$i];
      }
      $query.=" )";
      $matching_people=DB::select($query );

      foreach($matching_people as $person){
          array_push($matched_people,$person->userid);
      }

      $match_counts=array_count_values($matched_people);
      arsort($match_counts);
      
      $matched_people_data=array();
      foreach($match_counts as $userid=>$count){
         $r= DB::select("SELECT userid,displayname from users where userid=".$userid);
          array_push($matched_people_data,$r[0]);
         // echo sprintf('<x-matched_person userid="%d" displayname="JJ" />',$userid);
      }

      

      return view("dashboard",["userdata"=>$userdata,"matched_ids"=>$matched_people_data]);
  
    }
    return redirect("/login");
  }

  public function SignOut(){
    unset($_SESSION['logged_user']);
  }
}
