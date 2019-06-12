<?php

class AbstractRetrievalCoreDataAuthorPreferredName {
    
    private $doi;
    private $givenName;
    private $initials;
    private $surname;
    private $indexedName;

    public function __construct($doi=NULL, $givenName=NULL, $initials=NULL,
                                $surname=NULL, $indexedName=NULL ) {
        $this->doi;
        $this->givenName;
        $this->initials;
        $this->surname;
        $this->indexedName;
    }

    public function getDoi() {
        return $this->doi;
    }
    public function setDoi($doi) {
        $this->doi=$doi;
    }

    public function geGivenName() {
        return $this->givenName;
    }
    public function setGivenName($givenName) {
        $this->givenName=$givenName;
    }

    public function getInitials() {
        return $this->initials;
    }
    public function setInitials($initials) {
        $this->initials=$initials;
    }

    public function getSurname() {
        return $this->surname;
    }
    public function setSurname($surname) {
        $this->surname=$surname;
    }

    public function getIndexedName() {
        return $this->indexedName;
    }
    public function setIndexedName($indexedName) {
        $this->indexedName=$indexedName;
    }

    public function __toString() {
        return sprintf("%s;%s;%s;%s;%s\n", 
            $this->doi,
            $this->givenName,
            $this->initials,
            $this->surname,
            $this->indexedName
        );
    }
    
}
