<?php
require_once ('../model/Connection.php');
require_once ('../model/Classroom.php');
require_once ('../model/Classroom_rsv.php');
session_start();

$c_id = $_POST["c_id"];
$d_id = $_POST["d"];
$date = $_POST["date"];
$start_time = $_POST["startTime"];
$end_time = $_POST["endTime"];
$obj =  (isset($_POST["obj"])) ? $_POST["obj"] : array(); //多選的陣列元素不這樣寫會報錯
$activity = $_POST["activity"];
$note = $_POST["note"];

if(isset($_SESSION["level"]))
{
    if($_SESSION["level"]=='user' ||$_SESSION["level"]=='admin')
    {
        $start_time = $date.' '.$start_time;
        $end_time = $date.' '.$end_time;
        $user_id = $_SESSION["id"];
        $tmp = '';
        foreach($obj as $o) //轉換所有借用物品成一字串
        {
            if($tmp=='') $tmp=$o;
            else $tmp=$tmp.'<br>'.$o;
        }
        Classroom_rsv::create($c_id, $d_id, $user_id, $start_time, $end_time, $tmp, $activity, $note);
        header('Location: ../view/rsv/classroom_reservation.php');
    }
    else {
        header('Location: ../view/signin/home.php');
    }
}