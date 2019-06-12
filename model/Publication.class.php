<?php

require_once "model/Keyword.class.php";

class Publication {
    
    public $pubId;
    public $doi;
    public $title;
    public $abstract;
    public $author;
    public $pubType;
    public $linkWeb;
    public $linkDownload;
    public $jsonRetieval;
    public $jsonCrossref;
    public $jsonArticle;
    public $jsonScopus;

    public $authors;
    public $keywords;

    public function __construct(int $pubId=null, $doi=null, $title=null,
                                $abstract=null, $author=null, $pubType=null,
                                $linkWeb=null, $linkDownload=null, $jsonRetieval=null,
                                $jsonCrossref=null, $jsonArticle =null, $jsonScopus=null,
                                $authors=null, $keywords =null) {
        $this->pubId;
        $this->doi;
        $this->title;
        $this->abstract;
        $this->author;
        $this->pubType;
        $this->linkWeb;
        $this->linkDownload;
        $this->jsonRetieval;
        $this->jsonCrossref;
        $this->jsonArticle;
        $this->jsonScopus;

        $this->authors;
        $this->keywords;
    }

    public function getId(): int {
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

    public function getAuthor() {
        return $this->author;
    }
    public function setAuthor($author) {
        $this->author=$author;
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

    public function getJsonCrossref() {
        return $this->jsonCrossref;
    }
    public function setJsonCrossref($jsonCrossref) {
        $this->jsonCrossref=$jsonCrossref;
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
    
    public function getAuthors() {
        return $this->authors;
    }
    public function setAuthors($authors) {
        $this->authors=$authors;
    }

    public function getKeywords() {
        return $this->keywords;
    }
    public function setKeywords($keywords) {
        $this->keywords=$keywords;
    }

    public function __toString() {
        return sprintf("%s;%s;%s;%s;%s;%s;%s;%s;\n%s;\n%s\n%s\n%s\n", 
            $this->pubId,
            $this->doi,
            $this->title,
            $this->abstract,
            $this->author,
            $this->pubType,
            $this->linkWeb,
            $this->linkDownload,
            $this->jsonRetieval,
            $this->jsonCrossref,
            $this->jsonArticle,
            $this->jsonScopus
        );
    }

    public function jsonSerialize() {
        return [
            'pubId' =>  $this->pubId,
            'doi' =>  $this->doi,
            'title' =>  $this->title,
            'abstract' =>  $this->abstract,
            'author' =>  $this->author,
            'pubType' =>  $this->pubType,
            'linkWeb' =>  $this->linkWeb,
            'linkDownload' =>  $this->linkDownload,
            'jsonRetieval' =>  $this->jsonRetieval,
            'jsonCrossref' =>  $this->jsonCrossref,
            'jsonArticle' =>  $this->jsonArticle,
            'jsonScopus' =>  $this->jsonScopus,

            'authors' =>  $this->authors.jsonSerialize(),
            'keywords' =>  $this->keywords.jsonSerialize(),
        ];
    }

    
}
