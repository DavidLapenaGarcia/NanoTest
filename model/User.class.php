<?php
class User {
    public $userId;

    public $mail;
    public $password;

    public $firstname;
    public $surname;
    public $auid;
    public $initials;

    public $country;
    public $institutionName;
    
    

    public function __construct($userId=NULL,        $mail=NULL,     $password=NULL, 
                                $firstname=NULL,$surname=NULL,  $auid=NULL,
                                $initials=NULL, $country=NULL,  $institutionName=NULL
                                ) {
        $this->userId=$userId;

        $this->mail=$mail;
        $this->password=$password;

        $this->firstname=$firstname;
        $this->surname=$surname;
        $this->auid=$auid;
        $this->initials=$initials;

        $this->country=$country;
        $this->institutionName=$institutionName;
        
    }
    
    public function getId() {
        return $this->userId;
    }
    public function setId($userId) {
        $this->userId=$userId;
    }

    public function getMail() {
        return $this->mail;
    }
    public function setMail($mail) {
        $this->mail=$mail;
    }
    
    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password) {
        $this->password=$password;
    }
    
    public function getFirstname() {
        return $this->firstname;
    }
    public function setFirstname($firstname) {
        $this->firstname=$firstname;
    }

    public function getSurname() {
        return $this->surname;
    }
    public function setSurname($surname) {
        $this->surname=$surname;
    }

    public function getAuid() {
        return $this->auid;
    }
    public function setAuid($auid) {
        $this->auid=$auid;
    }

    public function getInitials() {
        return $this->initials;
    }
    public function setInitials($initials) {
        $this->initials=$initials;
    }

    public function getCountry() {
        return $this->country;
    }
    public function setCountry($country) {
        $this->country=$country;
    }
    public function getInstitutionName() {
        return $this->institutionName;
    }

    

    public function __toString() {
        return sprintf("%s;%s;%s;%s;%s;%s;%s;%s\n", 
        $this->userId=$userId,
        $this->mail=$mail,
        $this->password=$password,
        $this->firstname=$firstname,
        $this->surname=$surname,
        $this->auid=$auid,
        $this->initials=$initials,
        $this->country=$country,
        $this->institutionName=$institutionName
        );
    }
    
}
