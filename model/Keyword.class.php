<?php

class Keyword {
    
    public $keyWordId;
    public $totem;
    public $contented;


    public function __construct($keyWordId=NULL, $totem=NULL, $contented=NULL) {
        $this->keyWordId;
        $this->totem;
        $this->contented;
    }

    public function getId() {
        return $this->keyWordId;
    }
    public function setId($keyWordId) {
        $this->keyWordId=$keyWordId;
    }
    
    public function getTotem() {
        return $this->totem;
    }
    public function setTotem($totem) {
        $this->totem=$totem;
    }

    public function getContented() {
        return $this->contented;
    }
    public function setContented($contented) {
        $this->contented=$contented;
    }

    public function __toString() {
        return sprintf("%s;%s;%s\n", 
        $this->keyWordId,
        $this->totem,
        $this->contented
        );
    }

    public function jsonSerialize() {
        return [
            'keyWordId' =>  $this->keyWordId,
            'totem' =>  $this->totem,
            'contented' =>  $this->contented
        ];
    }
    
    
}
