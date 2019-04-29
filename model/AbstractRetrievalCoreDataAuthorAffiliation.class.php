<?php

class AbstractRetrievalCoreDataAuthorAffiliation {
    
    private $doi;
    private $id;
    private $initials;

    public function __construct($doi=NULL, $id=NULL, $href=NULL) {
        $this->doi;
        $this->id;
        $this->href;
    }

    public function getDoi() {
        return $this->doi;
    }
    public function setDoi($doi) {
        $this->doi=$doi;
    }

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id=$id;
    }

    public function getHref() {
        return $this->href;
    }
    public function setHref($href) {
        $this->href=$href;
    }

    
    public function __toString() {
        return sprintf("%s;%s;%s\n", 
            $this->doi,
            $this->id,
            $this->href
        );
    }
    
}
