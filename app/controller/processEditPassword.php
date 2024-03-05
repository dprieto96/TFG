<?php
session_start();

require_once("../model/services/userSA.php");
require_once("../model/domains/tUser.php");

$password = htmlspecialchars(trim(strip_tags($_POST["oldPassword"])));
$newPassword = htmlspecialchars(trim(strip_tags($_POST["newPassword"])));
$newPasswordRepeat = htmlspecialchars(trim(strip_tags($_POST["newPasswordRepeat"])));

$userSA = new UserSA();

$usuario = $_SESSION['usuario'];

$user = $userSA->editPassword($usuario, $password, $newPassword);

if($user != false){
    header('location: ../../index.php');
}else{
    
}
