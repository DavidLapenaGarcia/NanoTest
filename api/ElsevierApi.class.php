<?php
require_once "api/persist/ElsevierDAO.class.php";

class ElsevierApi {

    private $elsevier;

    public function __construct() {
        $this->elsevier = ElsevierDAO::getInstance();        
    }

    public function abstractRetrevial($toSearch, $searchAs) {
        $result = $this->elsevier->abstractRetrevial($toSearch, $searchAs);
        if(is_null($result)){
            return  $result;
        }else {
            array_push($_SESSION['error'], "Fail on ElsevierAPI");
            return NULL;
        }
    }
    
}
