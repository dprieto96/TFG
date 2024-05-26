<?php 
session_start();
require_once("../model/domains/tUser.php");
require_once("../model/services/userSA.php");



function regUserControler($user, $mail, $password, $idFaculty){
   
    $userSA = new UserSA();
    
    $correct = $userSA->registerNewUser($user, $mail, $password, $idFaculty);
    
    return $correct;
}

$nickUser = htmlspecialchars(trim(strip_tags($_POST["reg-username"])));
$mailUser = htmlspecialchars(trim(strip_tags($_POST["reg-email"])));
$password = htmlspecialchars(trim(strip_tags($_POST["reg-password"])));
$password2 = htmlspecialchars(trim(strip_tags($_POST["reg-confirm-password"])));
$idFaculty = htmlspecialchars(trim(strip_tags($_POST["idFacultad"])));


$correct = regUserControler($nickUser, $mailUser, $password, $idFaculty);


if($correct === true){
    $_SESSION['login'] = true;
    $_SESSION['usuario'] = $nickUser;
    $_SESSION['puntos'] = 0;
    $_SESSION['facultad'] = $idFaculty;
    $_SESSION['avatar'] = 'chico1.webp';
    $_SESSION['puntosExtra'] = 0;
    $_SESSION['ganador'] = 0;
    $_SESSION['lastPlay'] = 1900-01-01;
    header('location:  ../../index.php');
    exit();
} else if ($correct === -1) {
    // El correo electrónico ya está registrado
    $error_message = "El correo ya está registrado";
    //header('location:  ../../index.php?error=email_exists');
    //exit();
} else if ($correct === -2) {
    // El nombre de usuario ya está en uso
    $error_message = "El nombre de usuario ya existe";
    //header('location:  ../../index.php?error=username_exists');
    //exit();
} else {
    $_SESSION['login'] = false;
    $error_message = "Error desconocido";
    //header('location:  ../../index.php?error=false');
    //exit();
}

if(isset($error_message)){
    header('Location: ../../index.php?error_message=' . urlencode($error_message));
    exit();
}else{
    header('Location: ../../index.php');
    exit();
}

?>