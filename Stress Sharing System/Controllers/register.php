<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

//use Illuminate\Routing\Controller;

class register extends Controller
{
  public function __construct()
  {
    //session_start();
  }

  public function registration_form($error = "", $displayName = "", $email = "")
  {
    $max = DB::table("captchas")->max('id');
    $min = DB::table("captchas")->min('id');

    $r = DB::select("select question,answer from captchas where id=" . rand($min, $max));
    $question = $r[0]->question;
    $answer = md5($r[0]->answer);
    $_SESSION['captcha_ans'] = $r[0]->answer;

    return view("SignUp", ['displayName' => $displayName, 'email' => $email, 'error' => $error, 'captcha_que' => $question, 'captcha_ans' => $answer]);
  }



  public static function get_issues()
  {
    $r = DB::select("select issue as name from issues");
    return $r;
  }

  
  public function validate_user(Request $req)
  {
    $req->validate(
      [
        "displayName" => "required",
        "email" => "required|email",
        "password" => "required|min:8|max:12",
        "password_confirmation" => "required|same:password",
        "captcha" => "required"

      ]
    );
    $user_exist = DB::select(sprintf("SELECT count(email) as result from users where email ='%s'", $req['email']));

    if ($user_exist[0]->result) {
      return view("login", ["registration_message" => "You have already registered.....Please Login "]);
    }
    // session_start();
    if (($req['captcha']) != $_SESSION['captcha_ans']) {
      $validator = array("captcha" => "Wrong CAPTCHA...Human Verification Failed");
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }
    $flag=0;
    $spch = ['@', '&', '#', '!', '$'];
    $password = $req['password'];
    foreach ($spch as $ch) {
      if (strpos($password, $ch)) {
        $flag = 1;
        break;
      }
    }
    
    if($flag!=1){
      $validator = array("password" => "Password must have atleast one special character");
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }

    if (($req['captcha']) != $_SESSION['captcha_ans']) {
      $validator = array("captcha" => "Wrong CAPTCHA...Human Verification Failed");
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }

    //session_start();
    $_SESSION['user_info'] = $req->all();
    return redirect("/IssueMarking");
  }

  public function register_user(Request $req)
  {
    //db operation
    if (count($req->all()) <= 1) {
      $validator = array("empty_selection" => "You have not selected any field");
      return redirect("/IssueMarking")
        ->withErrors($validator)
        ->withInput();
    }

    // session_start();
    if (isset($_SESSION['user_info'])) {
      $user_info = $_SESSION['user_info'];
      unset($_SESSION['user_info']);

      $displayName = $user_info['displayName'];
      $email = $user_info['email'];
      $password = $user_info['password'];
      $match_str = array();



      $issue_arr = $req->all();
      unset($issue_arr['_token']);

      foreach ($issue_arr as $key => $value) {
        $arr = DB::select(sprintf("select id from issues where  issue='%s';", strtoupper($key)));
        $issue_id = $arr[0]->id;
        array_push($match_str, $issue_id);
      }

      $match_str = json_encode($match_str);
      // print '<br>'.$match_str;



      DB::insert('insert into users ( displayname,email,password,match_string) values (?, ?,?,?)', [$displayName, $email, $password, $match_str]);

      $r =   DB::select(sprintf("select userid from users where email='%s'", $email));
      $userid = $r[0]->userid;

      foreach (json_decode($match_str) as $issue) {
        DB::insert('insert into user_issues (userid,issueid) values (?, ?)', [$userid, $issue]);
      }
      return view("login", ["registration_message" => "Successfully Registered"]);
    }
    return redirect("/");
  }
}
