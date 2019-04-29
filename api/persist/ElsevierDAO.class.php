<?php
require_once "api/persist/ConnectApi.class.php";

class ElsevierDAO  {
    
    private static $instance = NULL; 
    private $url;
    private $apiKey;

    public function __construct() {
        $this->url = (new ConnectApi())->getUrl();
        $this->apiKey = (new ConnectApi())->getApiKey();
    }


    public static function getInstance(): ElsevierDAO {
        if (self::$instance == NULL) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function abstractRetrevial($toSearch, $searchAs) {
        // TODO validate bouth parametters
        $query;
        $api = "abstract/";
        $searchAs = "doi";

        switch ($searchAs){
            case "doi":
                $api = $api . "doi/";
                break;
            case "pii":
                $api = $api . "pii/";
                break;
            case "doi":
                $api = $api . "doi/";
                break;
            case "pubmed_id":
                $api = $subApi . "pubmed_id/";
                break;
            case "pui":
                $api = $api . "pui/";
                break;
            case "scopus_id":
                $api = $api . "scopus_id/";
                break;
            default:
                array_push($_SESSION['error'], "Invalid option to search");
                return NULL;
                break; 
        }
        $query = $this->url . $api . $toSearch . '?' . $this->apiKey;
        $result = $this->getJsonByQuery($query);

        return $result;
    }

    public function scopusAbstract($toSearch){
        $query;
        $api = "search/scopus?query=";

        $toSearch = 'ABS(' . urlencode($toSearch) . ')' . '&';
        $query = $this->url . $api . $toSearch . $this->apiKey;
        $result = $this->getJsonByQuery($query);

        return $result;

    }
    
    function getJsonByQuery($query) { 
        $headers = array("Accept: application/json"); 

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL,$query);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 60); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


        $data = curl_exec($ch); 

        if (!curl_errno($ch)) { 
            $apiData = $data;
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
