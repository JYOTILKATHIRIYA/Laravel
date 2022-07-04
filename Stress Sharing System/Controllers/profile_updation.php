<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class profile_updation extends Controller
{
    public static function get_issues($userid, $checked)
    {

        if ($checked) {
            $checked_issues = DB::select("SELECT issues.id,issue  FROM user_issues join issues on issues.id=user_issues.issueid where user_issues.userid=?", [$userid]);

            return $checked_issues;
        }
        $match_string = DB::table('users')->where('userid', $userid)->value('match_string');
        $match_string = json_decode($match_string);

        $query = "SELECT  id,issue  FROM issues  where not id in( " . $match_string[0];
        foreach ($match_string as $issue) {
            $query .= "," . $issue;
        }
        $query .= ");";

        $issues = DB::select($query);


        return $issues;
    }

    public function update_profile(Request $req)
    {
        $req->validate(
            [
                "userid" => "required",
                "displayname" => "required",
                "email" => "required|email",

            ]
        );

        $data = $req->all();
        $userid = $data['userid'];
        DB::update("UPDATE users SET displayname=? , email=? where userid=?", [$data['displayname'], $data['email'], $userid]);

        if ($data['password']) {
            if (!$data['password_confirmation']) {
                return redirect('/UpdateProfile')->withErrors([
                    "password_confirmation" => "Password Confirmation is required"
                ]);
            }
            $password = $data['password'];
            $req->validate(
                [
                    "password_confirmation"=>"same:password"
                ]
                );
            DB::update("UPDATE users SET password=? where userid=?", [$password, $userid]);
        }



        unset($data['_token']);
        unset($data['password']);
        unset($data['password_confirmation']);
        unset($data['email']);
        unset($data['displayname']);
        unset($data['userid']);



        if (count($data)) {

            DB::delete('delete from user_issues where userid = ?', [$userid]);

            foreach($data as $key=>$value){
                DB::insert("insert into user_issues(userid,issueid) values (?,?)",[$userid,$key]);
            }

            $match_string = json_encode(array_keys($data));
            DB::update("UPDATE users SET match_string=? where userid=?", [$match_string, $userid]);
        }

        return redirect("/UpdateProfile/1");
    }


    public static function get_mentor_issues($mentorid, $checked)
    {

        if ($checked) {
            $checked_issues = DB::select("SELECT issues.id,issue  FROM mentor_issues join issues on issues.id=mentor_issues.issueid where mentor_issues.mentorid=?", [$mentorid]);

            return $checked_issues;
        }

        $match_string = DB::table('mentors')->where('mentorid', $mentorid)->value('issue_string');
        $match_string = json_decode($match_string);

        $query = "SELECT  id,issue  FROM issues  where not id in( " . $match_string[0];
        foreach ($match_string as $issue) {
            $query .= "," . $issue;
        }
        $query .= ");";

        $issues = DB::select($query);


        return $issues;
    }

    public function update_mentor_profile(Request $req)
    {
        $req->validate(
            [
                "mentorid" => "required",
                "name" => "required",
                "email" => "required|email",
                "bio"=>"required",
                "profession"=>"required"
            ]
        );

        $data = $req->all();
        $mentorid = $data['mentorid'];

        DB::update("UPDATE mentors SET name=? , email=?,profession=?,bio=? where mentorid=?", [$data['name'], $data['email'],$data['profession'],$data['bio'], $mentorid]);

        if ($data['password']) {
            if (!$data['password_confirmation']) {
                return redirect()->back()->withErrors([
                    "password_confirmation" => "Password Confirmation is required"
                ]);
            }
            $password = $data['password'];
            $req->validate(
                [
                    "password_confirmation"=>"same:password"
                ]
                );
            DB::update("UPDATE mentors SET password=? where mentorid=?", [$password, $mentorid]);
        }



        unset($data['_token']);
        unset($data['password']);
        unset($data['password_confirmation']);
        unset($data['email']);
        unset($data['name']);
        unset($data['mentorid']);
        unset($data['bio']);
        unset($data['profession']);



        if (count($data)) {

            DB::delete('delete from mentor_issues where mentorid = ?', [$mentorid]);

            foreach($data as $key=>$value){
                DB::insert("insert into mentor_issues(mentorid,issueid) values (?,?)",[$mentorid,$key]);
            }

            $match_string = json_encode(array_keys($data));
            DB::update("UPDATE mentors SET issue_string=? where mentorid=?", [$match_string, $mentorid]);
        }

        return redirect("/MentorProfileUpdate/1");
    }

}
