<?php

require_once "model/persist/UserDbDAO.class.php";

class UserModel {

    private $dataUser;

    public function __construct() {
        // File
        $this->dataUser=UserDbDAO::getInstance();        
    }

    public function add($user):bool {
        $result = $this->dataUser->add($user);

        if ($result == FALSE && empty($_SESSION['error'])) {
            $_SESSION['error'] = UserMessage::ERR_DAO['insert'];
        }

        return $result;
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

    public function listAll():array {
        $users = $this->dataUser->listAll();

        return $users;
    }
    
}
