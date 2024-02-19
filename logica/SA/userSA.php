<?php

class UserSA{

    protected $dao;
    public function __construct() {
        $this->dao = new UserDAO();
    }

    public function registerNewUser($user, $mail, $password, $idFaculty){
        $objUser = new tUser($user, $mail, $password, $idFaculty);//¿Mejor hacerlo con constructor con parametros o sin?

        return $this->dao->registration($objUser);
    }

}

?>