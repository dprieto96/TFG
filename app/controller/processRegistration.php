<?php 

session_start();

require_once("../model/services/userSA.php");
require_once("../model/domains/tUser.php");

function regUserControler($user, $mail, $password, $idFaculty){
    //create usuarioSA
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
    $_SESSION['lastWin'] = null;
    header('location:  /TFG/index.php');
    exit();
} else if ($correct === -1) {
    // El correo electrónico ya está registrado
    header('location:  /TFG/index.php?error=email_exists');
    exit();
} else if ($correct === -2) {
    // El nombre de usuario ya está en uso
    header('location:  /TFG/index.php?error=username_exists');
    exit();
} else {
    $_SESSION['login'] = false;
    header('location:  /TFG/index.php?error=false');
    exit();
}
