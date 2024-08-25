<?php
require_once ('../model/Connection.php');
require_once ('../model/User.php');

$id = htmlspecialchars($_POST["id"]);
$password = htmlspecialchars($_POST["password"]);

if(User::login($id, $password)){
    header('Location: ../index.php');
} else {
    header('Location: ../index.php?fail=true');
}
