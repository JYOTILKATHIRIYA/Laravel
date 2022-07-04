<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboard extends Controller
{
    //
    public static function get_matches($userid)
    {
        $r = DB::select('select match_string from users where userid = ?', [$userid]);
        $issues_array = json_decode($r[0]->match_string);
        $matched_people = array();

        $query = sprintf("SELECT userid from user_issues where not userid=%d and (issueid=%d", $userid, $issues_array[0]);

        for ($i = 1; $i < count($issues_array); $i++) {
            $query .= " OR issueid=" . $issues_array[$i];
        }
        $query .= " )";
        $matching_people = DB::select($query);

        foreach ($matching_people as $person) {
            array_push($matched_people, $person->userid);
        }

        $match_counts = array_count_values($matched_people);

        // print_r($match_counts);


        //echo $query;
        $matched_people_data = array();
        foreach ($match_counts as $userid => $count) {
            $r = DB::select("SELECT userid,displayname from users where userid=" . $userid);
            array_push($matched_people_data, $r[0]);
        }

        return view("components/matched_person", ["matched_ids" => $matched_people_data]);
    }

    public static function mentor_suggetions($userid)
    {
        $r = DB::select('select match_string from users where userid = ?', [$userid]);
        $issues_array = json_decode($r[0]->match_string);
        $matched_mentors = array();

        $query = sprintf("SELECT mentorid from mentor_issues where  (issueid=%d", $issues_array[0]);

        for ($i = 1; $i < count($issues_array); $i++) {
            $query .= " OR issueid=" . $issues_array[$i];
        }
        $query .= " )";
        $matching_mentors = DB::select($query);
        $followed_mentors_obj = DB::select("SELECT mentorid from mentors_users where userid=?", [$userid]);

        foreach ($matching_mentors as $mentor) {
            array_push($matched_mentors, $mentor->mentorid);
        }

        $followed_mentors_arr = array();
        foreach ($followed_mentors_obj as $mentor) {
            array_push($followed_mentors_arr, $mentor->mentorid);
        }

        $matched_mentors = (array_diff($matched_mentors, $followed_mentors_arr));

        $match_counts = array_count_values($matched_mentors);
        arsort($match_counts);
        //print_r($match_counts);

        //echo $query;
        $matched_mentor_data = array();
        $i=1;
        foreach ($match_counts as $mentorid => $count) {
            if($i<=10){
            $r = DB::select("SELECT mentorid,name,profession,profile_pic from mentors where mentorid=" . $mentorid);
            array_push($matched_mentor_data, $r[0]);
            // echo sprintf('<x-matched_person userid="%d" displayname="JJ" />',$userid);
            $i++;
            }
        }

        return $matched_mentor_data;
    }
}
