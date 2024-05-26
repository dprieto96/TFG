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
    $error_message = "Nombre de usuario incorrecto";
    //header('Location:  ../../index.php?error=login_error_us');
    //exit();
}else if($user === -1){
    $_SESSION['login'] = false;
    $error_message = "Contraseña incorrecta";
    //header('Location:  ../../index.php?error=login_error_pass');
    //exit();
}
else if ($user != false) {
    $_SESSION['login'] = true;
    $_SESSION['usuario'] = $user->getUser();
    $_SESSION['puntos'] = $user->getPoints();
    $_SESSION['facultad'] = $user->getIdFaculty();
    $_SESSION['avatar'] = $user->getAvatar();
    $_SESSION['puntosExtra'] = $user->getPointsExtra();
    $_SESSION['ganador'] = $user->getWinner();
    $_SESSION['lastPlay'] = $user->getLastPlay();
    //header('location:  ../../index.php');
}else{
    $_SESSION['login'] = false;
    $error_message = "Error desconocido. Por favor, inténtelo de nuevo.";
    //header('Location:  ../../index.php?error=false');
    //exit();
}

if(isset($error_message)){
    header('Location: ../../index.php?error_message=' . urlencode($error_message));
    exit();
}else{
    header('Location: ../../index.php');
    exit();
}
