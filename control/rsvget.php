<?php
require_once('../model/Connection.php');
require_once('../model/Object.php');
require_once('../model/Object_rsv.php');
require_once('../model/Classroom.php');
require_once('../model/Classroom_rsv.php');
session_start();
//預約紀錄的按鈕們

//取消預約（by預約id）
if (isset($_GET['cancel'])) { 
    $id = $_GET['cancel'];
    Classroom_rsv::cancel($id);
    header('Location: ../view/rsv/classroom_reservation.php');
}
if (isset($_GET['cancel_o'])) { 
    $id = $_GET['cancel_o'];
    Object_rsv::cancel($id);
    header('Location: ../view/rsv/object_reservation.php');
}

// 審核狀態 0:未審核 / 1:已歸還完成 cfin  / 2:預約成功 cok / -1:歸還失敗 cfail  / -2:本人取消 cancel / -3:預約失敗 cnok
if (isset($_GET['type'])) {

    //預約通過: 2:未完成歸還
    if ($_GET['type'] == 'cok') {
        if (isset($_GET['id'])) {
            $id = htmlspecialchars($_GET['id']);
            Classroom_rsv::review($id, 2);
            header('Location: ../view/rsv/classroom_reservation.php');
        }
    }
    if ($_GET['type'] == 'cok_o') {
        if (isset($_GET['id'])) {
            $id = htmlspecialchars($_GET['id']);
            Object_rsv::review($id, 2);
            header('Location: ../view/rsv/object_reservation.php');
        }
    }

    //預約不通過: -3:預約失敗 + 寄信通知
    if ($_GET['type'] == 'cnok') {
        if (isset($_GET['id'])) {
            $id = htmlspecialchars($_GET['id']);
            if (isset($_GET['user_id'])) $mail = 's'.$_GET['user_id'].'@mail.ncyu.edu.tw';
            if (isset($_GET['cmt'])) $cmt = htmlspecialchars($_GET['cmt']);
            Classroom_rsv::review($id, -3);
            //寄信 
            header('Location: ../view/rsv/mail.php?To='.$mail.'&TextBody='.$cmt.'&turn=1'); //注意傳送方式變成get
            //header('Location: ../view/rsv/classroom_reservation.php');
        }
    }

    if ($_GET['type'] == 'cnok_o') {
        if (isset($_GET['id'])) {
            $id = htmlspecialchars($_GET['id']);
            if (isset($_GET['user_id'])) $mail = 's'.$_GET['user_id'].'@mail.ncyu.edu.tw';
            if (isset($_GET['cmt_o'])) $cmt_o = htmlspecialchars($_GET['cmt_o']);
            //echo 'id: ' . $_GET['user_id'] . '<br>';
            //echo 'To: ' . $mail . '<br>';
            //echo 'TextBody: ' . $cmt_o . '<br>';
            header('Location: ../view/rsv/mail.php?To='.$mail.'&TextBody='.$cmt_o.'&turn=0'); //注意傳送方式變成get
            Object_rsv::review($id, -3);
            //寄信 
            
            //header('Location: ../view/rsv/object_reservation.php');
        }
    }

    //歸還失敗: -1:失敗
    if ($_GET['type'] == 'cfail') {
        if (isset($_GET['id'])) {
            $id = htmlspecialchars($_GET['id']);
            Classroom_rsv::review($id, -1); //登記歸還失敗
            $d_id = Classroom_rsv::finds_by_id($id); //從預約紀錄找到借用單位，用來記錄違規
            $d = date("Y/m/d"); //檢查日期（前端沒寫到，我亂塞當前日期）
            
            //從借用單位找到已違規次數，用來記錄違規
            $conn = Connection::connect();
            $sql = "SELECT `vio_time` FROM `department_mng` WHERE `id`=?";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $d_id['d_id']);
            $response = Connection::exe($response, '取消');
            $vt = $response->fetch(PDO::FETCH_ASSOC);

            //從借用單位更新已違規次數
            $conn = Connection::connect();
            $sql = "UPDATE `department_mng` SET `vio_time`=? WHERE `id`=?";     # should add update option
            $response = $conn->prepare($sql);
            $vt = $vt['vio_time'] + 1; //違規次數++
            $response->bindParam(1, $vt);
            $response->bindParam(2, $d_id['d_id']);
            $response = Connection::exe($response, '取消');

            //從違規紀錄登記違規
            $conn = Connection::connect();
            $sql = "INSERT INTO  `violation_mng`(`d_id`,`c_rsv_id`,`detail`,`times`,`date`)  
            VALUES(:d_id,:c_rsv_id,:detail,:times,:date)";     # should add update option
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
            $response = $conn->prepare($sql);
            $response->bindParam(':d_id', $d_id['d_id']);
            $response->bindParam(':c_rsv_id', $id);
            $response->bindParam(':detail', $d_id['review_comment']);
            $response->bindParam(':times', $vt); //剛剛更新第幾次違規
            $response->bindParam(':date', $d);
            $response = Connection::exe($response, '取消');
            $vt = $response->fetch(PDO::FETCH_ASSOC);
            header('Location: ../view/rsv/classroom_reservation.php');
        }
    }

    if ($_GET['type'] == 'cfail_o') {
        if (isset($_GET['id'])) {
            $id = htmlspecialchars($_GET['id']);
            Object_rsv::review($id, -1); //登記歸還失敗
            $d_id = Object_rsv::finds_by_id($id); //從預約紀錄找到借用單位，用來記錄違規
            $d = date("Y/m/d"); //檢查日期（前端沒寫到，我亂塞當前日期）
            
            //從借用單位找到已違規次數，用來記錄違規
            $conn = Connection::connect();
            $sql = "SELECT `vio_time` FROM `department_mng` WHERE `id`=?";     # should add update option
            $response = $conn->prepare($sql);
            $response->bindParam(1, $d_id['d_id']);
            $response = Connection::exe($response, '取消');
            $vt = $response->fetch(PDO::FETCH_ASSOC);

            //從借用單位更新已違規次數
            $conn = Connection::connect();
            $sql = "UPDATE `department_mng` SET `vio_time`=? WHERE `id`=?";     # should add update option
            $response = $conn->prepare($sql);
            $vt = $vt['vio_time'] + 1; //違規次數++
            $response->bindParam(1, $vt);
            $response->bindParam(2, $d_id['d_id']);
            $response = Connection::exe($response, '取消');

            //從違規紀錄登記違規
            $conn = Connection::connect();
            $sql = "INSERT INTO  `violation_mng`(`d_id`,`c_rsv_id`,`detail`,`times`,`date`)  
            VALUES(:d_id,:c_rsv_id,:detail,:times,:date)";     # should add update option
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
            $response = $conn->prepare($sql);
            $response->bindParam(':d_id', $d_id['d_id']);
            $response->bindParam(':c_rsv_id', $id);
            $response->bindParam(':detail', $d_id['review_comment']);
            $response->bindParam(':times', $vt); //剛剛更新第幾次違規
            $response->bindParam(':date', $d);
            $response = Connection::exe($response, '取消');
            $vt = $response->fetch(PDO::FETCH_ASSOC);
            header('Location: ../view/rsv/object_reservation.php');
        }
    }

    //歸還完成: 1:通過
    if ($_GET['type'] == 'cfin') {
        if (isset($_GET['id'])) {
            $id = htmlspecialchars($_GET['id']);
            Classroom_rsv::review($id, 1);
            header('Location: ../view/rsv/classroom_reservation.php');
        }
    }
    if ($_GET['type'] == 'cfin_o') {
        if (isset($_GET['id'])) {
            $id = htmlspecialchars($_GET['id']);
            Object_rsv::review($id, 1);
            header('Location: ../view/rsv/object_reservation.php');
        }
    }

}

//儲存管理員回覆
if (isset($_POST['type'])) {
    if ($_POST['type'] == 'ccmt') {
        if (isset($_POST['id'])) {
            $id = htmlspecialchars($_POST['id']);
            if (isset($_POST['cmt']))
                $cmt = $_POST['cmt'];
            Classroom_rsv::review_com($id, $cmt);
            header('Location: ../view/rsv/classroom_reservation.php');
        }
    }
}

if (isset($_POST['type'])) {
    if ($_POST['type'] == 'ccmt_o') {
        if (isset($_POST['id'])) {
            $id = htmlspecialchars($_POST['id']);
            if (isset($_POST['cmt_o']))
                $cmt_o = $_POST['cmt_o'];
            Object_rsv::review_com($id, $cmt_o);
            header('Location: ../view/rsv/object_reservation.php');
        }
    }
}