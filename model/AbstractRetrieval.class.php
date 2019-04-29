<?php
require_once "model/AbstractRetrevialCoreData.class.php";
require_once "model/AbstractRetrievalAffiliation.class.php";
class AbstractRetrieval {
    
    private $doi;
    private $affiliation;
    private $coreData;

    public function __construct($doi=NULL, $affiliation=NULL, $coreData=NULL) {
        $this->doi=$doi;
        $this->affiliation=$affiliation;
        $this->coreData=$coreData;
    }

    public function getDoi(): string {
        return $this->doi;
    }
    public function setDoi($doi): string {
        $this->doi=$doi;
    }

    public function getAffiliation(): AbstractRetrievalAffiliation {
        return $this->affiliation;
    }
    public function setAffiliation($affiliation) {
        $this->affiliation=$affiliation;
    }

    public function getCoreData(): AbstractRetrevialCoreData {
        return $this->coreData;
    }
    public function setCoreData($coreData) {
        $this->coreData=$coreData;
    }

    public function __toString() {
        return sprintf("%s;%s;%s\n", 
            $this->doi , 
            $this->affiliation,
            $this->coreData);
    }
    
}
