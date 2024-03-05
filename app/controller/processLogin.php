<?php
session_start();

require_once("../model/services/userSA.php");
require_once("../model/domains/tUser.php");

$nickUser = htmlspecialchars(trim(strip_tags($_POST["username"])));
$password = htmlspecialchars(trim(strip_tags($_POST["password"])));

$userSA = new UserSA();

$user = $userSA->loginUser($nickUser, $password);

if ($user != false) {
    $_SESSION['login'] = true;
    $_SESSION['usuario'] = $user->getUser();
    $_SESSION['puntos'] = $user->getPoints();
    $_SESSION['facultad'] = $user->getIdFaculty();
    header('location: ../../index.php');
}else{
    $_SESSION['login'] = false;
    header('location: ../../index.php');
}



?>