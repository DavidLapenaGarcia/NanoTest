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
        $query;

        $subApi = "abstract/";
        $searchAs = "doi";

        switch ($searchAs){
            case "doi":
                $subApi = $subApi . "doi/";
                break;
            case "elsevier":
                $controlLogin = new ElsevierController();
                $controlLogin->processRequest();
                break;
            default:
                array_push($_SESSION['error'], "Fail on ElsevierDAO");
                return NULL;
                break; 
        }
        $query = $this->url . $subApi . $toSearch . $this->apiKey;
        
        file_put_contents('api/cache/cache.json', file_get_contents($query));
        /* 
        $file = fopen("api/cache/cache.json", "w");
        fwrite($file, file_get_contents($query));
        fclose($file)
        */;

        $apiData = json_decode( file_get_contents($query) );

        return $apiData;
    }

}
