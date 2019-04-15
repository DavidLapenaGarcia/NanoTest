<?php
class User {
    
    private $name;
    private $password;

    public function __construct($name=NULL, $password=NULL) {
        $this->name=$name;
        $this->password=$password;
    }
    
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name=$name;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password=$password;
    }

    public function __toString() {
        return sprintf("%s;%s\n", 
            $this->name , 
            $this->password);
    }
    
}
