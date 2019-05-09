<?php
require_once "DownloadApi/ElsevierAPI/persist/ElsevierDAO.class.php";

class ElsevierApi {

    private $elsevier;

    public function __construct() {
        $this->elsevier = ElsevierDAO::getInstance();        
    }

    public function abstractRetrieval($toSearch, $searchAs) {
        $result = $this->elsevier->getAbstractRetrieval($toSearch, $searchAs);
        if(!is_null($result)){
            return  $result;
        }else {
            array_push($_SESSION['error'], "Fail on ElsevierAPI abstractRetrevial");
            return NULL;
        }
    }


    public function articleRetrieval($toSearch) {
        // var_dump($toSearch);
        $result = $this->elsevier->getArticleRetrieval($toSearch);
        if(!is_null($result)){
            return  $result;
        }else {
            array_push($_SESSION['error'], "Fail on ElsevierAPI articleRetrevial");
            return NULL;
        }
    }


    public function scopusSearchByDoi($toSearch) {
        $result = $this->elsevier->getScopusByDoi($toSearch);
        if(!is_null($result)){
            return  $result;
        }else {
            array_push($_SESSION['error'], "Fail on ElsevierAPI ScopusSearch{doi}");
            return NULL;
        }
    }


    public function scopusAbstract($toSearch) {
        $result = $this->elsevier->getScopusSearchAbstract($toSearch);
        if(!is_null($result)){
            return  $result;
        }else {
            array_push($_SESSION['error'], "Fail on ElsevierAPI scopusAbstract");
            return NULL;
        }
    }

    public function scopusAuthor($auid, $name, $surname, $afid, $city, $country) {
        $result = $this->elsevier->getPubByScopusSearchAuthor($auid, $name, $surname, $afid, $city, $country);
        if(!is_null($result)){
            return  $result;
        }else {
            array_push($_SESSION['error'], "Fail on ElsevierAPI scopusAbstract");
            return NULL;
        }
    }
    
    function returnVirtualScopusSearch(){
        $str = file_get_contents('../api/Notes-Elsevier/returns/Scopus_Search/https%3A%2F%2Fapi.elsevier.com%2Fcontent%2Fsearch%2Fscopus?query=all(gene)&apiKey=7f59af901d2d86f78a1fd60c1bf9426a.json');
        $json = json_decode($str, true);
        return json_decode();
    }
}
