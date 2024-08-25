<?php
require_once('../model/Connection.php');
require_once('../model/Object.php');
require_once('../model/Object_rsv.php');
session_start();

$amount = $_POST["amount"];
$d_id = $_POST["d"];
$date = $_POST["date"];
$start_time = $_POST["startTime"];
$end_time = $_POST["endTime"];
$activity = $_POST["activity"];
$note = $_POST["note"];
$object = '';
foreach ($amount as $a) {
    foreach ($a as $key => $value) {
        if ($value > 0) {
            $object = $object . $key . ' ： ' . $value . '個<br>';
        }
    }
}
if(isset($_SESSION["level"]))
{
    if($_SESSION["level"]=='user' ||$_SESSION["level"]=='admin')
    {
        $start_time = $date.' '.$start_time;
        $end_time = $date.' '.$end_time;
        $user_id = $_SESSION["id"];
        $tmp = '';
        Object_rsv::create($d_id, $user_id, $start_time, $end_time, $object, $activity, $note);
        header('Location: ../view/rsv/object_reservation.php');
    }
    else {
        header('Location: ../view/signin/home.php');
    }
}