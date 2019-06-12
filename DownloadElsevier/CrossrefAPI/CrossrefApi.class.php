<?php
require_once "DownloadElsevier/CrossrefAPI/persist/CrossrefDAO.class.php";

class CrossrefApi {

    private $crossref;

    public function __construct() {
        $this->crossref = CrossrefDAO::getInstance();        
    }

    public function getData($toSearch, $searchAs) {
        $result = $this->crossref->getData($toSearch, $searchAs);
        if(!is_null($result)){
            return  $result;
        }else {
            array_push($_SESSION['error'], "Fail on crossrefAPI" );
            return NULL;
        }
    }

}
