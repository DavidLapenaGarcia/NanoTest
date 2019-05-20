<?php
class User {
    public $userId;
    public $name;
    public $password;
    public $mail;

    public function __construct($userId=NULL,$name=NULL, $password=NULL, $mail=NULL) {
        $this->userId=$userId;
        $this->name=$name;
        $this->password=$password;
        $this->mail=$mail;
    }
    
    public function getId() {
        return $this->userId;
    }
    public function setId($userId) {
        $this->userId=$userId;
    }

    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name=$name;
    }

    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password) {
        $this->password=$password;
    }

    public function getMail() {
        return $this->mail;
    }
    public function setMail($mail) {
        $this->mail=$mail;
    }

    public function __toString() {
        return sprintf("%s;%s;%s;%s\n", 
            $this->userId,  
            $this->name,
            $this->password,
            $this->mail);
    }
    
}
