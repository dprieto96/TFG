<?php

require_once("../model/services/userSA.php");
require_once("../model/domains/tUser.php");


class pointsController{

    protected $userSA;
    public function __construct() {
        $this->userSA = new userSA();
    }

    public function addScore($score){
        $_SESSION['puntos'] += $score;
        return $this->userSA->addScore($_SESSION['usuario'], $score);
    }

    public function addExtraScore($extraScore){
        $_SESSION['puntosExtra'] = $extraScore;
        return $this->userSA->addExtraScore($_SESSION['usuario'], $extraScore);
    }

}
?>