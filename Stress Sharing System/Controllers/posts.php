<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class posts extends Controller
{
    public function __construct()
    {
        //session_start();
    }
    public function create_post(Request $req)
    {
        $content = $req['content'];
        // session_start();
        $mentorid = $_SESSION['logged_mentor']->mentorid;
        DB::insert('insert into posts(mentorid, content) values (?, ?)', [$mentorid, $content]);
        return view("Components.mentor_dashboard_posts", ["mentorid" => $mentorid, "last_only" => 1]);
    }

    public static function count_likes($postid)
    {
        try {
            $total_likes = DB::table('post_likes')->where('postid', $postid)->count();
            if ($total_likes > 0)
                return $total_likes;
        } catch (Exception $e) {
            echo $e;
        }
    }
    public static function count_comments($postid)
    {
        try {
            $total_comments = DB::table('post_comments')->where('postid', $postid)->count();
            if ($total_comments > 0)
                return $total_comments;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public static function is_liked($postid)
    {
        // session_start();
        $userid = $_SESSION['logged_user']->userid;

        $r = DB::table('post_likes')->where('userid', $userid)->where('postid', $postid)->count();
        if ($r) return 1;
        return 0;
    }
    public function like_post(Request $req)
    {
        $postid = $req['postid'];
        // session_start();
        $userid = $_SESSION['logged_user']->userid;

        DB::insert('insert into post_likes (postid, userid) values (?, ?)', [$postid, $userid]);

        $total_likes = DB::table('post_likes')->where('postid', $postid)->count();
        return $total_likes;
    }

    public function unlike_post(Request $req)
    {
        $postid = $req['postid'];

        //  session_start();
        $userid = $_SESSION['logged_user']->userid;

        DB::delete('DELETE from post_likes where postid=? and userid=?', [$postid, $userid]);
        $total_likes = DB::table('post_likes')->where('postid', $postid)->count();
        if ($total_likes > 0) return $total_likes;
    }

    public function comment_on_post(Request $req)
    {

        $postid = $req['postid'];
        $comment = $req['comment'];
        //  session_start();
        $userid = $_SESSION['logged_user']->userid;

        DB::insert('INSERT into post_comments(postid,userid,comment) values(?,?,?) ', [$postid, $userid, $comment]);

        $total_comments = DB::table('post_comments')->where('postid', $postid)->count();
        if ($total_comments > 0) return $total_comments;
    }
    public static function get_content($postid)
    {
        $content = DB::select("SELECT content from posts where id=" . $postid);
        return $content[0]->content;
    }

    public static function get_comments($postid)
    {
        $comments = DB::select("SELECT displayname,comment from post_comments join users on post_comments.userid=users.userid where postid=? order by post_comments.created_at desc", [$postid]);
        return $comments;
    }



    public static function get_mentor_posts($last_only = 0)
    {

        $mentorid = $_SESSION['logged_mentor']->mentorid;

        if ($last_only) {



            $post = DB::select("SELECT id,Date_format(posts.created_at,'%e %b-%Y %H:%i %p') as date_time,profile_pic as mentorpic,name from posts join mentors on(posts.mentorid=mentors.mentorid) where posts.mentorid=" . $mentorid . " ORDER BY posts.created_at DESC LIMIT 1");
            return $post;
        }

        $post_ids = DB::select("SELECT id,Date_format(posts.created_at,'%e %b-%Y %H:%i %p') as date_time,profile_pic as mentorpic,name from posts join mentors on(posts.mentorid=mentors.mentorid) where posts.mentorid=" . $mentorid . " ORDER BY posts.created_at DESC");
        return $post_ids;
    }



    public static function get_mentor_profile_posts($mentorid)
    {

        $post_ids = DB::select("SELECT id,Date_format(posts.created_at,'%e %b-%Y %H:%i %p') as date_time,profile_pic as mentorpic,name from posts join mentors on(posts.mentorid=mentors.mentorid) where posts.mentorid=" . $mentorid . " ORDER BY posts.created_at DESC");
        return $post_ids;
    }

    public static function has_mentors()
    {
        $userid = $_SESSION['logged_user']->userid;

        $related_mentors = DB::select("SELECT mentorid from mentors_users where userid=?", [$userid]);

        if (!count($related_mentors)) return false;
        return true;
    }

    public static function get_user_related_posts()
    {
        // session_start();
        $userid = $_SESSION['logged_user']->userid;

        $related_mentors = DB::select("SELECT mentorid from mentors_users where userid=?", [$userid]);

        if (!count($related_mentors)) {
            $posts = DB::select("SELECT posts.id as post_id,name,date_format(posts.created_at,'%e %b-%Y %H:%i%p')as date_time,profile_pic as mentorpic,COUNT(post_likes.userid) as likes FROM `posts` join mentors on posts.mentorid=mentors.mentorid join post_likes on post_likes.postid=posts.id 
        group by post_likes.postid, 
        posts.id,
         name, 
         date_time, 
         mentorpic 
        ORDER by likes desc LIMIT 20");
            return $posts;
        }

        $query = "SELECT posts.id as post_id,name,date_format(posts.created_at,'%e %b-%Y %H:%i%p')as date_time,profile_pic as mentorpic FROM `posts` join mentors on posts.mentorid=mentors.mentorid WHERE DATEDIFF(date(NOW()),date(posts.created_at) )<7 AND posts.mentorid in(" . $related_mentors[0]->mentorid;

        foreach ($related_mentors as $mentor) {
            $query .= "," . $mentor->mentorid;
        }

        $query .= ") ORDER BY posts.created_at DESC";

        $posts = DB::select($query);

        if(!count($posts)||count($posts)<20){
            
            $query=str_replace("<7","<21",$query);
            
            $combine_posts = DB::select($query);

            if(!count($combine_posts)||count($combine_posts)<20){
            $combine_posts = DB::select("SELECT posts.id as post_id,name,date_format(posts.created_at,'%e %b-%Y %H:%i%p')as date_time,profile_pic as mentorpic,COUNT(post_likes.userid) as likes FROM `posts` join mentors on posts.mentorid=mentors.mentorid join post_likes on post_likes.postid=posts.id 
            group by post_likes.postid, 
            posts.id,
             name, 
             date_time, 
             mentorpic 
            ORDER by likes desc LIMIT 20");
            
            }
            $posts=array_merge($posts,$combine_posts);
            
        }

        return $posts;
    }

    public function delete_post(Request $req)
    {
        $postid = $req['postid'];
        DB::delete('delete from post_comments where postid = ?', [$postid]);
        DB::delete('delete from post_comment_mentors where postid = ?', [$postid]);
        DB::delete('delete from post_likes where postid = ?', [$postid]);
        DB::delete('delete from posts where id = ?', [$postid]);
    }

    public function get_post_to_update(Request $req, $msg = 0, $color = 0)
    {
        $postid = $req['postid'];
        $post = DB::select("SELECT id,name,date_format(posts.created_at,'%e %b-%Y %H:%i%p')as date_time,profile_pic as mentorpic FROM `posts` join mentors on posts.mentorid=mentors.mentorid WHERE posts.id=?", [$postid]);

        if ($msg)
            return view("components.post_updation", ["post" => $post[0], "message" => $msg, "color" => $color]);

        return view("components.post_updation", ["post" => $post[0]]);
    }

    public function update_post(Request $req)
    {
        $postid = $req['postid'];
        $content = $req['content'];
        if (!$content)
            return $this->get_post_to_update($req, "You can not post empty", "red");

        DB::update("UPDATE posts SET content=? WHERE id=?", [$content, $postid]);
        return $this->get_post_to_update($req, "Post Updated Successfully", "green");
    }

    public static function get_post_all(Request $req)
    {
        $postid = $req['postid'];
        $post = DB::select("SELECT id,name,date_format(posts.created_at,'%e %b-%Y %H:%i%p')as date_time,profile_pic as mentorpic FROM `posts` join mentors on posts.mentorid=mentors.mentorid where id=?", [$postid]);
        if (isset($req['mentor']))
            return view("components.display_all_comments", ["post" => $post[0]]);


        return view("components.post_display_comments", ["post" => $post[0]]);
    }
}
