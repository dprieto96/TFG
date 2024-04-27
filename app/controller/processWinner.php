<?php

require_once("../model/services/userSA.php");
require_once("../model/domains/tUser.php");


class processWinner{

    protected $userSA;
    public function __construct() {
        $this->userSA = new userSA();
    }

    public function winner(){
        $_SESSION['ganador'] = 1;
        $_SESSION['lastWin'] = date('Y-m-d');
        return $this->userSA->winner($_SESSION['usuario']);
    }

    public function resetWinner(){
        $_SESSION['ganador'] = 0;
        return $this->userSA->resetWinner($_SESSION['usuario']);
    }

}
?>