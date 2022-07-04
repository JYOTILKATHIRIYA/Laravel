<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class mentors extends Controller
{
    public static function get_mentor($mentorid)
    {
        $mentor_data = DB::select('select * from mentors where mentorid = ?', [$mentorid]);
        $mentor_data = $mentor_data[0];

        return view("mentors.mentor_profile", ["mentor" => $mentor_data]);
    }

    public function login(Request $req)
    {

        $req->validate([
            "mentor_email" => "required|email",
            "mentor_password" => "required"
        ]);
        try {
            $password = DB::table("mentors")->where('email', $req['mentor_email'])->value('password');
        } catch (Exception  $e) {
            echo "server is off";
            return;
        }
        if ($password) {
            if ($password == $req['mentor_password']) {
                $mentor_data = DB::select('select * from mentors where email = ?', [$req['mentor_email']]);
                //session_start();
                $_SESSION['logged_mentor'] = $mentor_data[0];
                return redirect("MentorDashboard");
            }
            return redirect()->back()->withErrors(["wrong_password" => "Password was incorrect"])->withInput();
        }

        return redirect()->back()->withErrors(["user_not_exists" => "Mentor Not Found"])->withInput();
    }

    public function dashboard()
    {
        //session_start();
        if (isset($_SESSION['logged_mentor'])) {

            return view("mentors.mentor_dashboard", ["mentor" => $_SESSION["logged_mentor"]]);
        }
        return redirect("/MentorLogin");
    }

    public static function count_followers($mentorid)
    {
        //  session_start();

        $followers = DB::table('mentors_users')->where('mentorid', $mentorid)->count();
        return $followers;
    }
    public static function is_follower($mentorid)
    {
        //session_start();
        if (isset($_SESSION['logged_user'])) {
            $userid = $_SESSION['logged_user']->userid;
            $is_follower = DB::table('mentors_users')->where('mentorid', $mentorid)->where('userid', $userid)->count('userid');
            return $is_follower;
        }
    }
    public static function get_followed_mentors(){
        $userid=$_SESSION['logged_user']->userid;
        $mentors=DB::select("SELECT m.mentorid,name,profile_pic from mentors m join mentors_users mu on m.mentorid=mu.mentorid where userid=?",[$userid]);
        return $mentors;
    }
    public function add_follower(Request $req)
    {
        //session_start();

        $userid = $_SESSION['logged_user']->userid;
        $mentorid = $req['mentorid'];

        if ($this->is_follower($mentorid)) {
            return $this->count_followers($mentorid);
        }
        //echo $userid;
        // echo $mentorid;
        DB::insert('insert into mentors_users (mentorid, userid) values (?, ?)', [$mentorid, $userid]);
        return $this->count_followers($mentorid);
    }

    public function remove_follower(Request $req)
    {
        //session_start();

        $userid = $_SESSION['logged_user']->userid;
        $mentorid = $req['mentorid'];

        if ($this->is_follower($mentorid)) {
            DB::delete('DELETE from mentors_users WHERE mentorid=? and userid=?', [$mentorid, $userid]);

            return $this->count_followers($mentorid);
        }
        //echo $userid;
        // echo $mentorid;
        return $this->count_followers($mentorid);
    }

    public function update_profile_picture(Request $req)
    {
        
        $filename = $_FILES['profile_picture']['name'];
        $email = $req["email"] . ' ';


        $ext = strtolower(
            pathinfo(
                basename($_FILES["profile_picture"]["name"]),
                PATHINFO_EXTENSION
            )
        );
        //echo $ext;

        $fname = "image" . rand(1, 1000);

        $baseurl = $_SERVER["DOCUMENT_ROOT"];

        $destination = $baseurl . "/temp_pro_pic/" . $fname . "." . $ext;

        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $destination);
        $src = $fname . "." . $ext;
        return view("mentors.change_profile_picture", ["src" => $src, "email" => $email]);
    }

    public function save_profile_pic(Request $req)
    {
        $filename = $req["src"];
        $mentor_email = $req["email"];
        $email = $req["email"];
        $old_profile_pic=DB::table('mentors')->where('email',$email)->value('profile_pic');
        
        $filePath = '\\temp_pro_pic\\' . $filename;
        $baseurl = $_SERVER["DOCUMENT_ROOT"];

        $email=str_replace(".com", "", $email);

        $ext = strtolower(
            pathinfo(
                $filename,
                PATHINFO_EXTENSION
            )
        );

        $filePath=$baseurl.$filePath;
        $destinationFilePath = $baseurl . '\profiles\\' . $email . "." . $ext;
        $old_profile_pic=$baseurl."\profiles\\".$old_profile_pic;
        $new_profile_pic=$email.".".$ext;


        //$myfile = '$root/images/theone.png';

        unlink($old_profile_pic);
        
        if (!copy($filePath, $destinationFilePath)) {
            return  "Updation Failed";
        } else {
            
            DB::update("UPDATE mentors set profile_pic=? where email=?",[$new_profile_pic,$mentor_email]);

            $mentor_reload=DB::select("select * from mentors where email=?",[$mentor_email]);
            //session_start();
            $_SESSION['logged_mentor']=$mentor_reload[0];
            return "<h1 style='text-align:center;color:green;font-family:sans-serif'>Profile Picture Updated</h1>";

        }


    }
}
