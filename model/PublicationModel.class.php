<?php

require_once "model/persist/PublicationDAO.class.php";

class PublicationModel {

    private $pubDAO;

    public function __construct() {
        $this->pubDAO=PublicationDAO::getInstance();        
    }


    public function listAll():array {
        $pubs = $this->pubDAO->listAll();
        return $pubs;
    }

    public function search($doi) {
        /* var_dump('<br/>PubDAO:::update::<br/>');
        var_dump($pub);
        var_dump('<br/><br/>'); */
        $result = $this->pubDAO->searchByDoi($doi);
        return $result;
    }

    public function searchId($id) {
        //var_dump($id);
        $result = $this->pubDAO->searchById($id);
        //var_dump($result);
        return $result;
    }
    
    public function add($pub):bool {
        $result = $this->pubDAO->add($pub);
        if ($result == FALSE && empty($_SESSION['error'])) {
            $_SESSION['error'] = PubMessage::ERR_DAO['insert'];
        }
        return $result;
    }
    
    public function update($pub):bool {
        $result=$this->pubDAO->update($pub);
        // var_dump($result);
        if ($result==FALSE) {
            $_SESSION['error']=PubMessage::ERR_DAO['update'];
        } 
        return $result;
    }
    public function delete($pubId):bool {
        $result=$this->pubDAO->delete($pubId);
        if ($result==FALSE) {
            $_SESSION['error']=PubMessage::ERR_DAO['delete'];
        } 
        return $result;
    }



    
    
}

