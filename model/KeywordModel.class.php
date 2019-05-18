<?php

require_once "model/persist/KeywordDAO.class.php";

class PublicationModel {

    private $keyDAO;

    public function __construct() {
        $this->keyDAO=PublicationDAO::getInstance();        
    }


    public function listAll():array {
        $keyws = $this->keyDAO->listAll();
        return $keyws;
    }

    public function listAllDistinct():array {
        $keyws = $this->keyDAO->listAll();
        return $keyws;
    }

    public function search($id) {
        /* var_dump('<br/>PubDAO:::update::<br/>');
        var_dump($pub);
        var_dump('<br/><br/>'); */
        $result = $this->keyDAO->searchId($id);
        return $result;
    }
    /* 
    //client
    public function searchKeyValue($id) {
        //var_dump($id);
        $result = $this->keyDAO->searchById($id);
        //var_dump($result);
        return $result;
    } */
    public function add($keyw):bool {
        $result = $this->keyDAO->add($keyw);
        if ($result == FALSE && empty($_SESSION['error'])) {
            $_SESSION['error'] = UserMessage::ERR_DAO['insert'];
        }
        return $result;
    }
    
    public function update($keyw):bool {
        $result=$this->keyDAO->update($keyw);
        // var_dump($result);
        if ($result==FALSE) {
            $_SESSION['error']=UserMessage::ERR_DAO['update'];
        } 
        return $result;
    }
    
    public function delete($id):bool {
        $result=$this->keyDAO->delete($id);
        if ($result==FALSE) {
            $_SESSION['error']=UserMessage::ERR_DAO['delete'];
        } 
        return $result;
    }



    
    
}

