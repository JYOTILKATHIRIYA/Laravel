<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class admin extends Controller
{
  //
  public static function mentor_requests($approved = 0, $rejected = 0)
  {
    try {
      if ($approved) {
        $r = DB::select("SELECT email,cv,date_format(requested_at,'%e %b-%Y')as date,date_format(requested_at,'%H:%i %p')as time  from mentor_requests where approved=1 ORDER BY requested_at DESC");
        return $r;
      }
      if ($rejected) {
        $r = DB::select("SELECT email,cv,date_format(requested_at,'%e %b-%Y')as date,date_format(requested_at,'%H:%i %p')as time  from mentor_requests_rejected  ORDER BY requested_at DESC");
        return $r;
      }
      $r = DB::select("SELECT email,cv,date_format(requested_at,'%e %b-%Y')as date,date_format(requested_at,'%H:%i %p')as time  from mentor_requests where approved=0 ORDER BY requested_at DESC");
      return $r;
      //  return view("mentor_requests");
    } catch (Exception $e) {
      //echo $e->getMessage();
      echo "Server is off";
    }
  }

  public function close_request(Request $req)
  {
    $email = $req['email'];

    if (isset($req['approval'])) {
      DB::update("UPDATE mentor_requests SET approved=1 where email=?", [$email]);
      return "APPROVED";
    }

    if (isset($req['undo_approval'])) {
      DB::update("UPDATE mentor_requests SET approved=0 where email=?", [$email]);
      return "APPROVAL REMOVED";
    }

    if (isset($req['undo_rejected'])) {
      DB::insert('INSERT into mentor_requests(email,cv,requested_at) select email,cv,requested_at from mentor_requests_rejected where email=?', [$email]);
      DB::delete("DELETE FROM mentor_requests_rejected WHERE email=?", [$email]);
      return "REJECTION REMOVED";
    }

    if (isset($req['remove_rejected'])) {
      DB::delete("DELETE FROM mentor_requests_rejected WHERE email=?", [$email]);
      return "REMOVED";
    }

    if (isset($req['reject'])) {
      DB::insert('INSERT into mentor_requests_rejected(email,cv,requested_at) select email,cv,requested_at from mentor_requests where email=?', [$email]);
      DB::delete("DELETE FROM mentor_requests WHERE email=?", [$email]);
      return "DELETED";
    }
  }

  public static function count_mentors()
  {
    $cnt = DB::table('mentors')->count();
    return $cnt;
  }

  public static function count_users()
  {
    $cnt = DB::table('users')->count();
    return $cnt;
  }

  public static function count_posts()
  {
    $cnt = DB::table('posts')->count();
    return $cnt;
  }

  public static function count_issues()
  {
    $cnt = DB::table('issues')->count();
    return $cnt;
  }

  public static function get_mentors_data($issue = 0)
  {
    //$data = DB::select("SELECT mentorid,name,email,profession,date_format(created_at,'%Y')as year from MENTORS ");
    if ($issue) {
      $data = DB::select("SELECT f.*,COUNT(p.id) as posts FROM
     (SELECT m.mentorid,m.name,m.profession,m.email,date_format(m.created_at,'%Y') as year,
     COUNT(userid)as followers from mentors m  left JOIN mentors_users mu on m.mentorid=mu.mentorid 
     GROUP BY 
     m.mentorid,
     m.name,
     m.profession,
     m.email,
     m.created_at) 
     f left JOIN posts p on f.mentorid=p.mentorid 
     join mentor_issues mi on f.mentorid=mi.mentorid where mi.issueid=?
     GROUP BY 
     f.mentorid,
     f.name,
     f.profession,
     f.followers,
     f.email,
     f.year
     ORDER BY f.followers DESC", [$issue]);
      return $data;
    }
    $data = DB::select("SELECT f.*,COUNT(p.id) as posts FROM
    (SELECT m.mentorid,m.name,m.profession,m.email,date_format(m.created_at,'%Y') as year,
    COUNT(userid)as followers from mentors m  left JOIN mentors_users mu on m.mentorid=mu.mentorid 
    GROUP BY 
    m.mentorid,
    m.name,
    m.profession,
    m.email,
    m.created_at) 
    f left JOIN posts p on f.mentorid=p.mentorid GROUP BY 
    f.mentorid,
    f.name,
    f.profession,
    f.followers,
    f.email,
    f.year
    ORDER BY f.followers DESC");
    return $data;
  }

  public static function get_users_data()
  {
    $data = DB::select("SELECT userid,displayname,email,date_format(created_at,'%Y')as year from users ");
    return $data;
  }

  public static function get_issues_data()
  {
    $data = DB::select("SELECT * from issues");

    foreach ($data as $row) {
      $users = DB::table('user_issues')->where('issueid', $row->id)->count();
      $mentors = DB::table('mentor_issues')->where('issueid', $row->id)->count();
      $row->users = $users;
      $row->mentors = $mentors;
    }
    return $data;
  }
  public  function search_mentor(Request $req)
  {

    if (!$req['search']) {
      $data = DB::select("SELECT f.*,COUNT(p.id) as posts FROM
      (SELECT m.mentorid,m.name,m.profession,m.email,date_format(m.created_at,'%Y') as year,
      COUNT(userid)as followers from mentors m  left JOIN mentors_users mu on m.mentorid=mu.mentorid 
      GROUP BY 
      m.mentorid,
      m.name,
      m.profession,
      m.email,
      m.created_at) 
      f left JOIN posts p on f.mentorid=p.mentorid GROUP BY 
      f.mentorid,
      f.name,
      f.profession,
      f.followers,
      f.email,
      f.year
      ORDER BY f.followers DESC");
      return view('Admin.mentor_search', ["result" => $data]);
    }

    $search = $req['search'] . '%';
    //$data = DB::select("SELECT mentorid,name,email,profession,date_format(created_at,'%Y')as year from MENTORS WHERE name Like ?", [$search]);
    $data = DB::select("SELECT f.*,COUNT(p.id) as posts FROM
    (SELECT m.mentorid,m.name,m.profession,m.email,date_format(m.created_at,'%Y') as year,
    COUNT(userid)as followers from mentors m  left JOIN mentors_users mu on m.mentorid=mu.mentorid 
    GROUP BY 
    m.mentorid,
    m.name,
    m.profession,
    m.email,
    m.created_at) 
    f left JOIN posts p on f.mentorid=p.mentorid 
    WHERE f.name Like ? GROUP BY 
    f.mentorid,
    f.name,
    f.profession,
    f.followers,
    f.email,
    f.year
    ORDER BY f.followers DESC", [$search]);
    return view('Admin.mentor_search', ["result" => $data]);
  }

  public function remove_mentor(Request $req)
  {
    $mentorid = $req['id'];
    $postids = DB::select("SELECT id from posts where mentorid=?", [$mentorid]);

    if (count($postids)) {
      $remove_like = "DELETE from post_likes where postid in(" . $postids[0]->id;
      $remove_comment = "DELETE from post_comments where postid in(" . $postids[0]->id;

      foreach ($postids as $post) {
        $remove_like .= "," . $post->id;
        $remove_comment .= "," . $post->id;
      }

      $remove_like .= ")";
      $remove_comment .= ")";

      DB::delete($remove_like);
      DB::delete($remove_comment);
      DB::delete("DELETE from posts where mentorid=?", [$mentorid]);
    }
    DB::delete("DELETE from mentors_users where mentorid=?", [$mentorid]);
    DB::delete("DELETE from mentor_issues where mentorid=?", [$mentorid]);
    DB::delete("DELETE from mentors where mentorid=?", [$mentorid]);

    return 1;
  }

  public function remove_user(Request $req)
  {
    $userid = $req['id'];

    DB::delete("DELETE from chat where sender = ? or reciever=?", [$userid, $userid]);
    DB::delete("DELETE from post_likes where userid=?", [$userid]);
    DB::delete("DELETE from post_comments where userid=?", [$userid]);
    DB::delete("DELETE from mentors_users where userid=?", [$userid]);
    DB::delete("DELETE from user_issues where userid=?", [$userid]);
    DB::delete("DELETE from users where userid=?", [$userid]);

    return 1;
  }

  public function edit_issue(Request $req)
  {

    $req->validate(
      [
        "id" => "required",
        "issue" => "required"
      ]
    );
    $id = $req['id'];
    $issue = $req['issue'];

    $issue = strtoupper(str_replace(" ", "_", $issue));
    DB::update("update issues set issue=? where id=?", [$issue, $id]);

    return 1;
  }

  public function remove_issue(Request $req)
  {
    $id = $req['id'];
    DB::delete("DELETE from mentor_issues where issueid=?", [$id]);
    DB::delete("DELETE from user_issues where issueid=?", [$id]);
    DB::delete("DELETE from issues where id=?", [$id]);

    return 1;
  }

  public function add_new_issue(Request $req)
  {
    $issue = $req['issue'];

    $issue = strtoupper(str_replace(" ", "_", $issue));
    DB::insert("insert into issues(issue) values(?)", [$issue]);
  }

  public static function get_feedbacks()
  {
    $data = DB::select("SELECT id,email,feedback,date_format(created_at,'%d %M, %Y')as date from feedbacks order by created_at desc");
    return $data;
  }
}
