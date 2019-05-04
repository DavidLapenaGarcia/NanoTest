<?php
require_once "DownloadApi/CrossrefAPI/persist/ConnectCrossref.class.php";

class CrossrefDAO  {
    
    private static $instance = NULL; 
    private $crossrefUrl;

    public function __construct() {
        $this->crossrefUrl = (new ConnectCrossref())->getUrl();
    }


    public static function getInstance(): CrossrefDAO {
        if (self::$instance == NULL) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getData($toSearch) {
        // TODO validate parametters
        $query = $this->crossrefUrl . $toSearch;
        $result = (new ConnectCrossref())->askJson($toSearch);
        // $result = $this->getJsonByQuery($query);

        return $result;
    }
    
    function getJsonByQuery($query) { 
        // FIXIT
        $headers = array(   'Accept: application/json'); 
        
        // $headers = array(   'Accept:'       => 'application/json','X-ELS-APIKey:' => $this->apiKey);

        $ch = curl_init(); 
        curl_setopt($ch,    CURLOPT_URL,               $query);
        curl_setopt($ch,    CURLOPT_CUSTOMREQUEST,     'GET'); 
        curl_setopt($ch,    CURLOPT_RETURNTRANSFER,    1); 
        curl_setopt($ch,    CURLOPT_TIMEOUT,           60); 
        curl_setopt($ch,    CURLOPT_HTTPHEADER,        $headers);
        $data = curl_exec($ch); 

        if (!curl_errno($ch)) { 
            $apiData = $data;
            $apiData = json_decode($apiData, true);
            // var_dump($data); 
        } else {
            // TODO : Add errors message
            // var_dump( curl_error($ch) ); 
            array_push($_SESSION['error'], curl_error($ch));
            $apiData = NULL;
        } 
        curl_close($ch); 
        return $apiData;
    }

}
