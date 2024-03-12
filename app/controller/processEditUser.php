<?php
session_start();

require_once("../model/services/userSA.php");
require_once("../model/domains/tUser.php");

$newNickUser = htmlspecialchars(trim(strip_tags($_POST["username"])));

$oldNick = $_SESSION['usuario'];

$userSA = new UserSA();


$user = $userSA->editUser($newNickUser, $oldNick);

if($user === true){
    $_SESSION['usuario'] = $newNickUser;
    header('location:  /TFG/index.php');
}else if($user === -1){
    // Este nombre de usuario ya esta registrado
    header('location:  /TFG/index.php?error=error_edit_user');
    exit();
}
else{
    header('location:  /TFG/index.php?error=false');
    exit();
}