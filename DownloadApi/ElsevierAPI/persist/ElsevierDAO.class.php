<?php
require_once "DownloadApi/ElsevierAPI/persist/ConnectElsevier.class.php";

class ElsevierDAO  {
    
    private static $instance = NULL; 
    private $elsevierUrl;
    private $apiKey;

    public function __construct() {
        $this->elsevierUrl = (new ConnectElsevier())->getUrl();
        $this->apiKey = (new ConnectElsevier())->getApiKey();
    }


    public static function getInstance(): ElsevierDAO {
        if (self::$instance == NULL) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getAbstractRetrieval($toSearch, $searchAs) {
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
        $query = $this->elsevierUrl . $api . $toSearch . '?' . $this->apiKey;
        $result = $this->getJsonByQuery($query);

        return $result;
    }

    public function getArticleRetrieval($toSearch) {
        $api = "article/doi/";

        $query = $this->elsevierUrl . $api . $toSearch . '?' . $this->apiKey;
        $result = $this->getJsonByQuery($query);
        return $result;
    }

    public function getScopusByDoi($toSearch) {
        $api = "search/scopus?query=";

        $toSearch = 'DOI(' . urlencode($toSearch) . ')' . '&';
        $query = $this->elsevierUrl . $api . $toSearch . $this->apiKey;
        var_dump($query);
        $result = $this->getJsonByQuery($query);
        return $result;
    }

    public function getScopusSearchAbstract($toSearch){
        $query;
        $api = "search/scopus?query=";

        $toSearch = 'ABS(' . urlencode($toSearch) . ')' . '&';
        $query = $this->elsevierUrl . $api . $toSearch . $this->apiKey;
        $result = $this->getJsonByQuery($query);

        return $result;

    }
    
    function getJsonByQuery($query) { 
        // FIXIT
        $headers = array(   'Accept: application/json'); 
        /*
        $headers = array(   'Accept:'       => 'application/json', 
                            'X-ELS-APIKey:' => $this->apiKey);
        */
        $ch = curl_init(); 
        curl_setopt($ch,    CURLOPT_URL,               $query);
        curl_setopt($ch,    CURLOPT_CUSTOMREQUEST,     'GET'); 
        curl_setopt($ch,    CURLOPT_RETURNTRANSFER,    1); 
        curl_setopt($ch,    CURLOPT_TIMEOUT,           60); 
        curl_setopt($ch,    CURLOPT_HTTPHEADER,        $headers);
        $data = curl_exec($ch); 

        // var_dump($data);

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
