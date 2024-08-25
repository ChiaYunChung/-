<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

/*if (isset($_GET["address"])) 
   $to = $_GET["address"]; // 取得收件地址
else
   $to = "s1102962@mail.ncyu.edu.tw";*/
//if (isset($_GET["To"]) && isset($_GET["TextBody"])) {
    //$to = $_GET["To"];
    //$textbody = $_GET["TextBody"];
    //echo " ". $to ." ". $textbody ." ";
    $turn = $_GET["turn"];
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->CharSet = 'UTF-8';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;  //SSL
//$mail->Port = 587;  //TLS
    $mail->SMTPSecure = 'ssl';
    //$mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = "2023ncyucsie@gmail.com";
    $mail->Password = "nyie cqjh aely jxyf";
    //$mail->Username = $_POST["From"];
//$mail->Password = $_POST["Password"];
//$mail->setFrom('your.google@gmail.com', 'from');
//$mail->From = $_POST["From"]; //設定寄件者信箱     
//$mail->Subject = $_POST["Subject"];
    $mail->setFrom('2023ncyucsie@gmail.com', 'from');
    $mail->addAddress($_GET["To"], 'mailto');
    $mail->From = '2023ncyucsie@gmail.com'; //設定寄件者信箱     
    $mail->Subject = "Department Office Borrowing Notice";
    $mail->Body = $_GET["TextBody"];

    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        //echo "Message sent!";
        if($turn==1) header('Location: classroom_reservation.php');
        else header('Location: object_reservation.php');
    }
//}
?>