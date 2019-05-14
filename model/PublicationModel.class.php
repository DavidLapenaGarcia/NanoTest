<?php

require_once "model/persist/PublicationDAO.class.php";

class PublicationModel {

    private $dataPub;

    public function __construct() {
        $this->dataPub=PublicationDAO::getInstance();        
    }



    public function listAll():array {
        $pubs = $this->dataPub->listAll();
        return $pubs;
    }

    public function search($doi) {
        $result = $this->dataPub->searchByDoi($doi);
        return $result;
    }

    public function add($pub):bool {
        $result = $this->dataPub->add($pub);
        if ($result == FALSE && empty($_SESSION['error'])) {
            $_SESSION['error'] = UserMessage::ERR_DAO['insert'];
        }
        return $result;
    }
    
    public function modify($pub):bool {
        $result=$this->dataPub->modify($pub);
        if ($result==FALSE) {
            $_SESSION['error']=UserMessage::ERR_DAO['update'];
        } 
        return $result;
    }
    public function delete($pubId):bool {
        $result=$this->dataPub->delete($pubId);
        if ($result==FALSE) {
            $_SESSION['error']=UserMessage::ERR_DAO['delete'];
        } 
        return $result;
    }



    
    
}

