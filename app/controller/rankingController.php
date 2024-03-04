<?php

require_once("../model/services/rankingSA.php");
require_once("../model/domains/tUser.php");


class RankingController{

    protected $rankingSA;
    public function __construct() {
        $this->rankingSA = new rankingSA();
    }

    public function getUserRanking(){
        return $this->rankingSA->getUserRanking();
    }

    public function getFacultyRanking(){
        return $this->rankingSA->getFacultyRanking();
    }

}