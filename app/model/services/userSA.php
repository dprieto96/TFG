<?php

require_once("../model/DAO/userDAO.php");
require_once("../model/domains/tUser.php");


class UserSA{

    protected $dao;
    public function __construct() {
        $this->dao = new UserDAO();
    }

    public function loginUser($user, $password) {
        $objUser = new tUser();

        $objUser->initUser($user, $password);

        return $this->dao->login($objUser);
    }

    public function registerNewUser($user, $mail, $password, $idFaculty){
        $objUser = new tUser();

        $objUser->regNewUser($user, $mail, $password, $idFaculty);

        return $this->dao->registration($objUser);
    }

    public function editUser($newUser, $oldUser){
        return $this->dao->editUser($newUser, $oldUser);
    }

    public function editPassword($usuario, $oldPassword, $newPassword){
        return $this->dao->editPassword($usuario, $oldPassword, $newPassword);
    }

    public function editAvatar($usuario, $avatarURL){
        return $this->dao->editAvatar($usuario, $avatarURL);
    }

}

?>