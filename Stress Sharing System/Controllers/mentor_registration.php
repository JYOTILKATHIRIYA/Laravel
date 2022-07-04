<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class mentor_registration extends Controller
{
    public function __construct()
    {
        //session_start();
    }

    public function request_form()
    {
        $max = DB::table("captchas")->max('id');
        $min = DB::table("captchas")->min('id');

        $r = DB::select("select question,answer from captchas where id=" . rand($min, $max));
        $question = $r[0]->question;
        $answer = md5($r[0]->answer);
        $_SESSION['captcha_ans'] = $r[0]->answer;
        return view("mentors/mentor_request_form", ["captcha_que" => $question, "captcha_ans" => $answer]);
    }

    public function send_request(Request $req)
    {

        $req->validate(
            [
                "mentor_email" => "required|email",
                "mentor_cv" => "required",
                "captcha" => "required"
            ]
        );



        if ($req['captcha'] != $_SESSION['captcha_ans']) {
            $validator = array("wrong_captcha" => "Wrong CAPTCHA...Human Verification Failed");
            return redirect("/MentorRequest")
                ->withErrors($validator)
                ->withInput();
        }


        $fname = str_replace(".", "", $req["mentor_email"]);

        $baseurl = $_SERVER["DOCUMENT_ROOT"];


        $ext = strtolower(
            pathinfo(
                basename($_FILES["mentor_cv"]["name"]),
                PATHINFO_EXTENSION
            )
        );

        $destination = $baseurl . "/cvs/" . $fname . "." . $ext;

        $is_requested = DB::select("select count(id) as cnt from mentor_requests where email='" . $req['mentor_email'] . "'");

        if ($is_requested[0]->cnt) {

            $validator = array("already_requested" => "You have already requested");
            return redirect("/MentorRequest")
                ->withErrors($validator)
                ->withInput();
        }
        DB::insert('insert into mentor_requests (email, cv) values (?, ?)', [$req['mentor_email'], "$fname.$ext"]);
        // echo $destination . '<br><br>';

        move_uploaded_file($_FILES["mentor_cv"]["tmp_name"], $destination);

        echo "Your application has been sent.... You will get an email when your application get reviewed by us ";
        //print_r($req->all());

    }


    public function validate_mentor(Request $req)
    {

        $req->validate(
            [
                "mentor_name" => "required",
                "mentor_email" => "required|email",
                "mentor_profession" => "required",
                "mentor_bio" => "required",

                "mentor_password" => "required|min:8|max:12|same:mentor_password_confirm",
                "mentor_password_confirm" => "required"
            ]
        );

        $flag = 0;
        $spch = ['@', '&', '#', '!', '$'];
        $password = $req['mentor_password'];
        foreach ($spch as $ch) {
            if (strpos($password, $ch)) {
                $flag = 1;
                break;
            }
        }

        if ($flag != 1) {
            $validator = array("mentor_password" => "Password must have atleast one special character");
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        if (DB::table('mentors')->where('email', $req['mentor_email'])->count()) {
            return redirect()->back()->withErrors(["Registered_mentor" => "You have Alredy registered"]);
        }

        if (DB::table('mentor_requests')->where('email', $req['mentor_email'])->value('approved')) {

            $_SESSION['mentor_reg_data'] = $req->all();
            return view('mentors.issue_marking');
        }
        return redirect()->back()->withErrors(["Request_not_approved" => "Your request is not approved for the registration"])->withInput();
    }

    public function return_validate_form(){
        if(isset($_SESSION['mentor_reg_data']))
        return view('mentors.issue_marking');
    
        return redirect("/MentorRegistration");
    }

    public function register(Request $req)
    {
        if(!$req["mentor_profilepic"]){
            $validator = array("mentor_profilepic" => "You have not uploaded your profile picture");
            return redirect('/validate_mentor')
                ->withErrors($validator)
                ->withInput();
        }

        if (count($req->all()) <= 2) {
            $validator = array("empty_selection" => "You have not selected any field");
            return redirect('/validate_mentor')
                ->withErrors($validator)
                ->withInput();
        }

        //session_start();
        if (isset($_SESSION['mentor_reg_data'])) {
            $mentor_info = $_SESSION['mentor_reg_data'];
            unset($_SESSION['mentor_reg_data']);

            $name = $mentor_info['mentor_name'];
            $email = $mentor_info['mentor_email'];
            $profession = $mentor_info['mentor_profession'];
            $bio = $mentor_info['mentor_bio'];
            //$profile_pic=$mentor_info['mentor_profilepic'];
            $password = $mentor_info['mentor_password'];
            $match_str = array();



            $issue_arr = $req->all();
            unset($issue_arr['_token']);
            unset($issue_arr['mentor_profilepic']);

            foreach ($issue_arr as $key => $value) {
                $arr = DB::select(sprintf("select id from issues where  issue='%s';", strtoupper($key)));
                $issue_id = $arr[0]->id;
                array_push($match_str, $issue_id);
            }

            $match_str = json_encode($match_str);
            // print '<br>'.$match_str;

            $fname = str_replace(".com", "", $email);

            $baseurl = $_SERVER["DOCUMENT_ROOT"];


            $ext = strtolower(
                pathinfo(
                    basename($_FILES["mentor_profilepic"]["name"]),
                    PATHINFO_EXTENSION
                )
            );

            $destination = $baseurl . "/profiles/" . $fname . "." . $ext;

            DB::insert('insert into mentors ( name,email,profession,bio,password,issue_string,profile_pic) values (?, ?,?,?,?,?,?)', [$name, $email, $profession, $bio, $password, $match_str, $fname . "." . $ext]);

            move_uploaded_file($_FILES["mentor_profilepic"]["tmp_name"], $destination);

            $r =   DB::select(sprintf("select mentorid from mentors where email='%s'", $email));
            $mentorid = $r[0]->mentorid;

            foreach (json_decode($match_str) as $issue) {
                DB::insert('insert into mentor_issues (mentorid,issueid) values (?, ?)', [$mentorid, $issue]);
            }
            return redirect("/MentorLogin");
        }
        return redirect("/");
    }
}
