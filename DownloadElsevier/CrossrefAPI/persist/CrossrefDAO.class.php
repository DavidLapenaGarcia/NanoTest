<?php
require_once "DownloadElsevier/CrossrefAPI/persist/ConnectCrossref.class.php";

class CrossrefDAO  {
    private static $instance = NULL;

    public function __construct() {
    }

    public static function getInstance(): CrossrefDAO {
        if (self::$instance == NULL) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getData($toSearch) {
        // TODO validate parametters
        $result = (new ConnectCrossref())->askJson($toSearch);
        // $result = $this->getJsonByQuery($query);
        

        return $result;
    }


}
