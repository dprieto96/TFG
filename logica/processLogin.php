<?php
session_start();


$nickUser = htmlspecialchars(trim(strip_tags($_POST[""])));
$mailUser = htmlspecialchars(trim(strip_tags($_POST[""])));

$userSA = new UserSA();

//llamar a la funcion del dao para hacer login



?>