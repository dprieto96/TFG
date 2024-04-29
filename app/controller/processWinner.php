<?php

require_once("../model/services/userSA.php");
require_once("../model/domains/tUser.php");


class processWinner{

    protected $userSA;
    public function __construct() {
        $this->userSA = new userSA();
    }

    //Al ganar el reto diario se marca en la bd y en la variable de sesión como ganado y se apunta en la bd y en la variable de sesión la fecha del reto realizado
    public function winner(){
        $_SESSION['ganador'] = 1;
        $_SESSION['lastPlay'] = date('Y-m-d');
        return $this->userSA->winner($_SESSION['usuario']);
    }

    //Al perder el reto se marca como perdido y se apunta la fecha (así si alguien se salta el reto un día todavía tendrá la fecha antigua y se podrá controlar el acceso al juego extra)
    public function loser(){
        $_SESSION['ganador'] = 0;
        $_SESSION['lastPlay'] = date('Y-m-d');
        return $this->userSA->loser($_SESSION['usuario']);
    }

}
?>