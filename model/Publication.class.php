<?php

class Publication {
    
    public $pubId;
    public $doi;
    public $title;
    public $abstract;
    public $authors;
    public $pubType;
    public $linkWeb;
    public $linkDownload;
    public $jsonRetieval;
    public $jsonCossref;
    public $jsonArticle;
    public $jsonScopus;

    public function __construct($pubId=NULL, $doi=NULL, $title=NULL,
                                $abstract=NULL, $authors=NULL, $pubType=NULL,
                                $linkWeb=NULL, $linkDownload=NULL, $jsonRetieval=NULL,
                                $jsonCossref=NULL, $jsonArticle = NULL, $jsonScopus=NULL) {
        $this->pubId;
        $this->doi;
        $this->title;
        $this->abstract;
        $this->authors;
        $this->pubType;
        $this->linkWeb;
        $this->linkDownload;
        $this->jsonRetieval;
        $this->jsonCossref;
        $this->jsonArticle;
        $this->jsonScopus;
    }

    public function getId() {
        return $this->pubId;
    }
    public function setId($pubId) {
        $this->pubId=$pubId;
    }
    
    public function getDoi() {
        return $this->doi;
    }
    public function setDoi($doi) {
        $this->doi=$doi;
    }

    public function getTitle() {
        return $this->title;
    }
    public function setTitle($title) {
        $this->title=$title;
    }

    public function getAbstract() {
        return $this->abstract;
    }
    public function setAbstract($abstract) {
        $this->abstract=$abstract;
    }

    public function getAuthors() {
        return $this->authors;
    }
    public function setAuthors($authors) {
        $this->authors=$authors;
    }

    public function getPubType() {
        return $this->pubType;
    }
    public function setPubType($pubType) {
        $this->pubType=$pubType;
    }

    public function getLinkWeb() {
        return $this->linkWeb;
    }
    public function setLinkWeb($linkWeb) {
        $this->linkWeb=$linkWeb;
    }

    public function getLinkDownload() {
        return $this->linkDownload;
    }
    public function setLinkDownload($linkDownload) {
        $this->linkDownload=$linkDownload;
    }

    public function getJsonRetieval() {
        return $this->jsonRetieval;
    }
    public function setJsonRetieval($jsonRetieval) {
        $this->jsonRetieval=$jsonRetieval;
    }

    public function getJsonCossref() {
        return $this->jsonCossref;
    }
    public function setJsonCossref($jsonCossref) {
        $this->jsonCossref=$jsonCossref;
    }

    public function getJsonArticle() {
        return $this->jsonArticle;
    }
    public function setJsonArticle($jsonArticle) {
        $this->jsonArticle=$jsonArticle;
    }

    public function getJsonScopus() {
        return $this->jsonScopus;
    }
    public function setJsonScopus($jsonScopus) {
        $this->jsonScopus=$jsonScopus;
    }
    
    public function __toString() {
        return sprintf("%s;%s;%s;%s;%s;%s;%s;%s;\n%s;\n%s\n%s\n%s\n", 
            $this->pubId,
            $this->doi,
            $this->title,
            $this->abstract,
            $this->authors,
            $this->pubType,
            $this->linkWeb,
            $this->linkDownload,
            $this->jsonRetieval,
            $this->jsonCossref,
            $this->jsonArticle,
            $this->jsonScopus
        );
    }
    
}
