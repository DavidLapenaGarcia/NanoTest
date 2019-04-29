<?php
require_once "api/persist/ElsevierDAO.class.php";

class ElsevierApi {

    private $elsevier;

    public function __construct() {
        $this->elsevier = ElsevierDAO::getInstance();        
    }

    public function abstractRetrevial($toSearch, $searchAs) {
        $result = $this->elsevier->abstractRetrevial($toSearch, $searchAs);
        if(!is_null($result)){
            return  $result;
        }else {
            array_push($_SESSION['error'], "Fail on ElsevierAPI");
            return NULL;
        }
    }

    public function scopusAbstract($toSearch) {
        $result = $this->elsevier->scopusAbstract($toSearch);
        if(!is_null($result)){
            return  $result;
        }else {
            array_push($_SESSION['error'], "Fail on ElsevierAPI");
            return NULL;
        }
    }
    
    function returnVirtualScopusSearch(){
        $str = file_get_contents('../api/Notes-Elsevier/returns/Scopus_Search/https%3A%2F%2Fapi.elsevier.com%2Fcontent%2Fsearch%2Fscopus?query=all(gene)&apiKey=7f59af901d2d86f78a1fd60c1bf9426a.json');
        $json = json_decode($str, true);
        return json_decode();
    }
}
