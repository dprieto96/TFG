<?php 
session_start();

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

if($password == $password2){

    $correct = regUserControler($nickUser, $mailUser, $password, $idFaculty);

    if($correct){
        $_SESSION['login'] = true;
    }else{
        header('location: index.php?passwordfailure=true');
    }

}else{

}

?>
