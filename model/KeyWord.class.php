<?php

class KeyWord {
    
    private $keyWordId;
    private $key;
    private $value;


    public function __construct($keyWordId=NULL, $key=NULL, $value=NULL) {
        $this->keyWordId;
        $this->key;
        $this->value;
    }

    public function getId() {
        return $this->keyWordId;
    }
    public function setId($keyWordId) {
        $this->keyWordId=$keyWordId;
    }
    
    public function getKey() {
        return $this->key;
    }
    public function setKey($key) {
        $this->key=$key;
    }

    public function getValue() {
        return $this->value;
    }
    public function setValue($alue) {
        $this->value=$value;
    }

    public function __toString() {
        return sprintf("%s;%s;%s\n", 
        $this->keyWordId,
        $this->key,
        $this->value
        );
    }
    
}
