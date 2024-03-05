<?php
session_start();

require_once("../model/services/userSA.php");
require_once("../model/domains/tUser.php");

$newNickUser = htmlspecialchars(trim(strip_tags($_POST["username"])));

$oldNick = $_SESSION['usuario'];

$userSA = new UserSA();


$user = $userSA->editUser($newNickUser, $oldNick);

if($user != false){
    $_SESSION['usuario'] = $newNickUser;
    header('location: ../../index.php');
}else{
    header('location: ../../index.php');
}