<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class chat extends Controller
{

    private $logged_userid;
    public function __construct()
    {
        $this->logged_userid = $_SESSION['logged_user']->userid;
    }
    
    public static function get_talkers_names()
    {
        //session_start();
        $userid = $_SESSION['logged_user']->userid;

        $regex1 = "%" . $userid;
        $regex2 = $userid . "%";
        $r =   DB::select("SELECT distinct 	abs( (sender+reciever)-? )  as talkerid FROM chat where msg_session LIKE ? or msg_session LIKE ? ", [$userid, $regex1, $regex2]);

        $talkers = array();

        foreach ($r as $talker) {
            $name = DB::table('users')->where('userid', $talker->talkerid)->value('displayname');
            $talker_obj = (object)["id" => $talker->talkerid, "name" => $name];
            array_push($talkers, $talker_obj);
        }
        return $talkers;
    }

    public static function get_last_message($talkerid)
    {
        $userid = $_SESSION['logged_user']->userid;
        $last_msg = DB::select("SELECT message from chat where msg_time=( select max(msg_time) from chat where (sender=? and reciever=?) or  (reciever=? and sender =?) ) ", [$userid, $talkerid, $userid, $talkerid]);
        $total_unreads = Db::select("SELECT count(message) as cnt from chat where readed=0 and ( reciever=? and sender =? )", [$userid, $talkerid]);
        return (object)["last_message" => $last_msg[0]->message, "total_unreads" => $total_unreads[0]->cnt];
    }

    public function get_messages(Request $req)
    {
        //session_start();
        $talker = $req['talker'];
        $user = $_SESSION['logged_user']->userid;

        $regex1 = $talker . "_" . $user;
        $regex2 = $user . "_" . $talker;
        $messages = DB::select("SELECT sender,message,reciever from(select sender,message,reciever,msg_time from chat where msg_session LIKE ? or msg_session LIKE ? order by msg_time desc LIMIT 30)LastRows order by msg_time;", [$regex1, $regex2]);

        DB::update("UPDATE chat SET readed=1 where msg_session LIKE ?  ", [$regex1]);

        return view('components.messages', ["messages" => $messages, "user" => $user]);
    }


    public function send_message(Request $req)
    {
        //session_start();
        $talker = $req['talker'];
        $user = $_SESSION['logged_user']->userid;
        $msg_session = $user . "_" . $talker;

        $message = $req['message'];

        DB::insert("INSERT INTO chat(message,sender,reciever,msg_session) values(?,?,?,?)", [$message, $user, $talker, $msg_session]);
        return $message;
    }

    public function get_unreads()
    {
       // session_start();
        $user = $_SESSION['logged_user']->userid;

        $unreads = DB::table("chat")->where('reciever', $user)->where('readed', 0)->count();

        return $unreads;
    }

    public function get_chats(Request $req)
    {
        $talker = $req['talker'];
        $user = $this->logged_userid;

        $regex1 = $talker . "_" . $user;
        $messages = DB::select("select message from chat where msg_session LIKE ? and readed=0 order by msg_time", [$regex1]);


        foreach($messages as $message){
            printf("
            <div  class='msg_con'>
              <span class='recieved'>%s</span>
          </div>
            ",$message->message);
        }

        DB::update("UPDATE chat SET readed=1 where msg_session LIKE ?  and readed=0", [$regex1]);

    }

}
