<?php
class tUser{
    private $user;
    private $mail;
    private $password;
    private $idFaculty;
    private $points;
    private $avatar;//TODO

    //builder
    public function __construct($user, $mail, $password, $idFaculty){
        $this->user = $user;
        $this->mail = $mail;
        $this->password = $password;
        $this->idFaculty = $idFaculty;
        $this->points = 0;
    }

    public static function newtUser(){
        return new self("","","","",);
    }

    //Funciones GET y SET de los atrivutos
    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getMail() {
        return $this->mail;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getIdFaculty() {
        return $this->idFaculty;
    }

    public function setIdFaculty($idFaculty) {
        $this->idFaculty = $idFaculty;
    }

    public function getPoints() {
        return $this->points;
    }

    public function setPoints($points) {
        $this->points = $points;
    }

    public function getAvatar() {
        return $this->avatar;
    }

    public function setAvatar($avatar) {
        $this->avatar = $avatar;
    }
}

?>