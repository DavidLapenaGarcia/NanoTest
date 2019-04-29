<?php

class AbstractRetrievalCoreDataAuthorPreferredName {
    
    private $doi;
    private $fa;
    private $rel;
    private $href;

    public function __construct($doi=NULL, $fa=NULL, $rel=NULL,
                                $href=NULL) {
        $this->doi;
        $this->fa;
        $this->rel;
        $this->href;
    }

    public function getDoi() {
        return $this->doi;
    }
    public function setDoi($doi) {
        $this->doi=$doi;
    }

    public function geFa() {
        return $this->fa;
    }
    public function setFa($fa) {
        $this->fa=$fa;
    }

    public function getRel() {
        return $this->rel;
    }
    public function setRel($rel) {
        $this->rel=$rel;
    }

    public function getHref() {
        return $this->href;
    }
    public function setHref($href) {
        $this->href=$href;
    }

    public function __toString() {
        return sprintf("%s;%s;%s;%s\n", 
            $this->doi,
            $this->fa,
            $this->rel,
            $this->href
        );
    }
    
}
