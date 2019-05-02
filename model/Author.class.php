<?php

class Author {
    
    private $authorId;
    private $auid;
    private $surname;
    private $initials;
    private $url;
    private $publications;
    private $jsonRetrieval;

    public function __construct($authorId=NULL, $auid=NULL, $surname=NULL,
                                $initials=NULL, $url=NULL, $publications=NULL,
                                $jsonRetrieval=NULL) {
        $this->authorId;
        $this->auid;
        $this->surname;
        $this->initials;
        $this->url;
        $this->publications;
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

    public function getUrl() {
        return $this->url;
    }
    public function setUrl($url) {
        $this->url=$url;
    }

    public function getPublications() {
        return $this->publications;
    }
    public function setPublications($publications) {
        $this->publications=$publications;
    }

    public function getJsonRetrieval() {
        return $this->jsonRetrieval;
    }
    public function setJsonRetrieval($jsonRetrieval) {
        $this->jsonRetrieval=$jsonRetrieval;
    }

    
    public function __toString() {
        return sprintf("%s;%s;%s;%s;%s;%s;\n%s\n", 
        $this->authorId,
        $this->auid,
        $this->surname,
        $this->initials,
        $this->url,
        $this->publications,
        $this->jsonRetrieval
        );
    }
    
}
