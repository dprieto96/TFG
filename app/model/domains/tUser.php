<?php
class tUser{
    
    private $user;
    private $mail;
    private $password;
    private $idFaculty;
    private $points;
    private $avatar;

    public function __construct(){
       
    }

    public function loginUser($user, $mail, $password, $idFaculty, $points, $avatar){
        $this->user = $user;
        $this->mail = $mail;
        $this->password = $password;
        $this->idFaculty = $idFaculty;
        $this->points = $points;
        $this->avatar = $avatar;
    }

    public function regNewUser($user, $mail, $password, $idFaculty){
         
        $this->user = $user;
        $this->mail = $mail;
        $this->password = $password;
        $this->idFaculty = $idFaculty;
        $this->points = 0;
        $this->avatar = 'chico1.webp';
        
    }

    public function initUser($user, $password){
        $this->user = $user;
        $this->password = $password;
    }

    //Funciones GET
    public function getUser() {
        return $this->user;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getIdFaculty() {
        return $this->idFaculty;
    }

    public function getPoints() {
        return $this->points;
    }

    public function getAvatar() {
        return $this->avatar;
    }
}

?>
