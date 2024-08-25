<?php
require_once ('../model/Connection.php');
require_once ('../model/User.php');

$name = htmlspecialchars($_POST["sname"]);
$id = htmlspecialchars($_POST["sid"]);
$phone = htmlspecialchars($_POST["phonenum"]);
$mail = htmlspecialchars($_POST["mail"]);
$password = htmlspecialchars($_POST["password"]);

if(User::create($id, $password, $name, 'user', $phone, $mail)){
    header('Location: ../index.php');
} else {
    header('Location: ../index.php?fail=true');
}
