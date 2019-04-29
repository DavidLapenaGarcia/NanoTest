<?php
class AbstractRetrievalAffiliation {
    
    private $doi;
    private $city;
    private $name;
    private $country;

    public function __construct($doi=NULL, $city=NULL, $name=NULL, $country=NULL) {
        $this->doi=$doi;
        $this->city=$city;
        $this->name=$name;
        $this->country=$country;
    }

    public function getDoi(): string {
        return $this->doi;
    }
    public function setDoi($doi): string {
        $this->doi=$doi;
    }

    public function getCity() {
        return $this->city;
    }
    public function setCity($city) {
        $this->city=$city;
    }

    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name=$name;
    }

    public function getCountry() {
        return $this->country;
    }
    public function setCountry($country) {
        $this->country=$country;
    }

    public function __toString() {
        return sprintf("%s;%s\n", 
            $this->doi , 
            $this->password);
    }
    
}
