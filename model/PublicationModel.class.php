<?php

require_once "model/persist/PublicationDAO.class.php";

class PublicationModel {

    private $dataPub;

    public function __construct() {
        // File
        $this->dataPub=PublicationDAO::getInstance();        
    }

    public function add($pub):bool {
        $result = $this->dataUser->add($user);

        if ($result == FALSE && empty($_SESSION['error'])) {
            $_SESSION['error'] = UserMessage::ERR_DAO['insert'];
        }
        return $result;
    }
    
    public function listAll():array {
        $pubs = $this->dataPub->listAll();

        return $pubs;
    }

    public function modify($user):bool {
        $result=$this->dataUser->modify($user);
        
        if ($result==FALSE) {
            $_SESSION['error']=UserMessage::ERR_DAO['update'];
        } 
        
        return $result;
    }

    public function searchByName($name) {
        $result = $this->dataUser->searchByName($name);
        
        return $result;
    }

    
    
}

