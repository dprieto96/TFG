<?php

require_once("../model/DAO/rankingDAO.php");
require_once("../model/domains/tUser.php");


class rankingSA{

    protected $dao;
    public function __construct() {
        $this->dao = new RankingDAO();
    }

    public function getRanking(){
        return $this->dao->getRanking();
    }

}