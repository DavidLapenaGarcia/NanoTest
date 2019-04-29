<?php
require_once "model/AbstractRetrievalCoreDataAuthorAffiliation.class.php";
require_once "model/AbstractRetrievalCoreDataAuthorPreferredName.class.php";

class AbstractRetrievalCoreDataAuthor {

    private $doi;
    private $preferredName;
    private $affiliation;
    private $seq;
    private $initials;
    private $fa;
    private $surname;
    private $auId;
    private $authorUrl;
    private $indexedName;

    public function __construct($doi=NULL, $preferredName=NULL, $affiliation=NULL,
                                $seq=NULL, $initials=NULL, $fa=NULL,
                                $surname=NULL, $auId=NULL, $authorUrl=NULL,
                                $indexedName=NULL, $city=NULL, $name=NULL, 
                                $country=NULL
                                ) {
        $this->doi;
        $this->preferredName;
        $this->affiliation;
        $this->seq;
        $this->initials;
        $this->fa;
        $this->surname;
        $this->auId;
        $this->authorUrl;
        $this->indexedName;
    }

    public function getDoi() {
        return $this->doi;
    }
    public function setDoi($doi) {
        $this->doi=$doi;
    }

    public function getPreferredName(): AbstractRetrievalCoreDataAuthorPreferredName {
        return $this->preferredName;
    }
    public function setPreferredName($preferredName) {
        $this->preferredName=$preferredName;
    }

    public function getAffiliation(): AbstractRetrievalCoreDataAuthorAffiliation {
        return $this->affiliation;
    }
    public function setAffiliation($affiliation) {
        $this->affiliation=$affiliation;
    }

    public function getSeq() {
        return $this->seq;
    }
    public function setSeq($seq) {
        $this->seq=$seq;
    }

    public function getInitials() {
        return $this->initials;
    }
    public function setInitials($initials) {
        $this->initials=$initials;
    }

    public function getFa() {
        return $this->fa;
    }
    public function setFa($fa) {
        $this->fa=$fa;
    }

    public function getSurname() {
        return $this->surname;
    }
    public function setSurname($surname) {
        $this->surname=$surname;
    }

    public function getAuId() {
        return $this->auId;
    }
    public function setAuId($auId) {
        $this->auId=$auId;
    }

    public function getAuthorUrl() {
        return $this->authorUrl;
    }
    public function setAuthorUrl($authorUrl) {
        $this->authorUrl=$authorUrl;
    }
    
    public function getIndexedName() {
        return $this->indexedName;
    }
    public function setIndexedName($indexedName) {
        $this->indexedName=$indexedName;
    }



    public function __toString() {
        return sprintf("%s;%s;%s;%s;%s;%s;%s;%s;%s;\n", 
            $this->doi,
            $this->preferredName,
            $this->affiliation,
            $this->seq,
            $this->initials,
            $this->fa,
            $this->surname,
            $this->auId,
            $this->authorUrl,
            $this->indexedName
        );
    }
    
}
