<?php
session_start();


$nickUser = htmlspecialchars(trim(strip_tags($_POST["username"])));
$mailUser = htmlspecialchars(trim(strip_tags($_POST["password"])));

$userSA = new UserSA();
$user = $userSA->loginUser($nickUser, $password);

if ($user != NULL) {
    $_SESSION['login'] = true;
    $_SESSION['usuario'] = $user->getUser();
    $_SESSION['puntos'] = $user->getPoints();
    header('location: index.php');
}else{
    $_SESSION['login'] = false;
}



?>