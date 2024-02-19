<?php

class UserSA{

    protected $dao;
    public function __construct() {
        $this->dao = new UserDAO();
    }

    public function registerNewUser($user, $mail, $password, $idFaculty){
        $objUser = new tUser();
        $objUser->regNewUser($user, $mail, $password, $idFaculty);
        
        return $this->dao->registration($objUser);
    }

}

?>