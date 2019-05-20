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

    public function update($user):bool {
        $result=$this->dataUser->update($user);
        
        if ($result==FALSE) {
            $_SESSION['error']=UserMessage::ERR_DAO['update'];
        } 
        
        return $result;
    }

    public function delete($userId):bool {
        $result=$this->dataUser->delete($userId);
        if ($result==FALSE) {
            $_SESSION['error']=UserMessage::ERR_DAO['delete'];
        } 
        return $result;
    }
    
    public function searchValid($name, $password) {
        $result = $this->dataUser->searchName($name);
        if (!is_null($result)) {
            $result = $this->dataUser->searchValid($name, $password);
            /* var_dump('<br/>');
            var_dump($result); */
            if(is_null($result)){
                $_SESSION['error']=UserMessage::ERR_DAO['invalid_password'];
            } 
        }else{
            $_SESSION['error']=UserMessage::ERR_DAO['not_exists_email'];  
        }
        
        return $result;
    }

    public function searchById($userId) {
        $result = $this->dataUser->searchById($userId);
        
        return $result;
    }

    public function listAll():array {
        $users = $this->dataUser->listAll();

        return $users;
    }
    
}
