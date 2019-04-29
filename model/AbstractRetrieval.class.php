<?php
class AbstractRetrieval {
    
    private $doi;
    private $affiliation;

    public function __construct($doi=NULL, $affiliation=NULL) {
        $this->doi=$doi;
        $this->affiliation=$affiliation;
    }

    public function getDoi(): string {
        return $this->doi;
    }
    public function setDoi($doi): string {
        $this->doi=$doi;
    }

    public function getAffiliation() {
        return $this->affiliation;
    }
    public function setAffiliation($affiliation) {
        $this->affiliation=$affiliation;
    }

    public function __toString() {
        return sprintf("%s;%s\n", 
            $this->doi , 
            $this->password);
    }
    
}
