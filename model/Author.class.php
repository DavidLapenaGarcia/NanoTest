<?php

class Author {
    
    private $authorId;

    private $auid;
    private $firstname;
    private $surname;
    private $initials;

    private $country;
    private $institutionName;
    private $url;
    private $jsonRetrieval;

    public function __construct($authorId=NULL, $auid=NULL, $firstname=NULL,
                                $surname=NULL, $initials=NULL, $country=NULL, $institutionName=NULL,
                                $url=NULL, $jsonRetrieval=NULL) {
        $this->authorId;

        $this->auid;
        $this->firstname;
        $this->surname;
        $this->initials;

        $this->country;
        $this->institutionName;

        $this->url;
        $this->jsonRetrieval;
    }

    public function getAuthorId() {
        return $this->authorId;
    }
    public function setAuthorId($authorId) {
        $this->authorId=$authorId;
    }
    
    public function getAuid() {
        return $this->auid;
    }
    public function setAuid($auid) {
        $this->auid=$auid;
    }

    public function getFirstname() {
        return $this->name;
    }
    public function setFirstname($name) {
        $this->name=$name;
    }

    public function getSurname() {
        return $this->surname;
    }
    public function setSurname($surname) {
        $this->surname=$surname;
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
    public function setInstitutionName($institutionName) {
        $this->institutionName=$institutionName;
    }

    public function getUrl() {
        return $this->url;
    }
    public function setUrl($url) {
        $this->url=$url;
    }

    public function getJsonRetrieval() {
        return $this->jsonRetrieval;
    }
    public function setJsonRetrieval($jsonRetrieval) {
        $this->jsonRetrieval=$jsonRetrieval;
    }

    
    public function __toString() {
        return sprintf("%s;%s;%s;%s;%s;%s;%s;%s;%s\n", 
        $this->authorId,
        $this->auid,
        $this->firstname,
        $this->surname,
        $this->initials,
        $this->country,
        $this->institutionName,
        $this->url,
        $this->jsonRetrieval
        );
    }


    public function jsonSerialize() {
        return [
            'authorId'          =>  $this->authorId,
            'auid'              =>  $this->auid,
            'name'              =>  $this->name,
            'surname'           =>  $this->surname,
            'initials'          =>  $this->initials,
            'country'           =>  $this->country,
            'institutionName'   =>  $this->institutionName,
            'url'               =>  $this->url,
            'jsonRetrieval'     =>  $this->jsonRetrieval,
        ];
    }
    
}
