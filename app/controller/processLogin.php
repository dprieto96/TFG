<?php
session_start();

require_once("../model/services/userSA.php");
require_once("../model/domains/tUser.php");

$nickUser = htmlspecialchars(trim(strip_tags($_POST["username"])));
$password = htmlspecialchars(trim(strip_tags($_POST["password"])));

$userSA = new UserSA();

$user = $userSA->loginUser($nickUser, $password);

if($user === -2){
    $_SESSION['login'] = false;
    header('Location:  /TFG/index.php?error=login_error_us');
    exit();
}else if($user === -1){
    $_SESSION['login'] = false;
    header('Location:  /TFG/index.php?error=login_error_pass');
    exit();
}
else if ($user != false) {
    $_SESSION['login'] = true;
    $_SESSION['usuario'] = $user->getUser();
    $_SESSION['puntos'] = $user->getPoints();
    $_SESSION['facultad'] = $user->getIdFaculty();
    $_SESSION['avatar'] = $user->getAvatar();
    $_SESSION['puntosExtra'] = $user->getPointsExtra();
    $_SESSION['ganador'] = $user->getWinner();
    $_SESSION['lastWin'] = $user->getLastWin();
    header('location:  /TFG/index.php');
}else{
    $_SESSION['login'] = false;
    header('Location:  /TFG/index.php?error=false');
    exit();
}

