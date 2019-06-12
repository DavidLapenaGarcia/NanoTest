<?php
require_once "DownloadElsevier/ElsevierAPI/persist/ConnectElsevier.class.php";

class ElsevierDAO  {
    
    private static $instance = NULL; 
    private $elsevierUrl;
    private $apiKey;

    public function __construct() {

    }

    public static function getInstance(): ElsevierDAO {
        if (self::$instance == NULL) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getAbstractRetrieval($toSearch, $searchAs) {
        $query;
        $api = "abstract/";
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
        $query = $api . $toSearch;

        $result = (new ConnectElsevier())->askJson($query);
        return $result;
    }

    public function getArticleRetrieval($toSearch) {
        $api = "article/doi/";
        $query = $api . $toSearch;

        $result = (new ConnectElsevier())->askJson($query);
        if ( array_key_exists( "service-error", $result ) ) {
         
            $result=NULL;
        }
        return $result;
        // There must no to use urlencode() to the $toSearch attribute:
        //Bad:   https://api.elsevier.com/content/article/doi/10.1016%2FS0014-5793%2801%2903313-0?apiKey=8932ae370b77efdfd90cbe1e78f27211
        //Good:  https://api.elsevier.com/content/article/doi/10.1016/S0014-5793(01)03313-0?apiKey=8932ae370b77efdfd90cbe1e78f27211
        
    }

    public function getScopusByDoi($toSearch) {
        $api = "search/scopus?query=";
        $toSearch = 'DOI(' . urlencode($toSearch) . ')';
        $query = $api . $toSearch;

        $result = (new ConnectElsevier())->askJson($query);

        return $result;
    }

    public function getScopusSearchAbstract($toSearch){
        $api = "search/scopus?query=";
        $toSearch = 'ABS(' . urlencode($toSearch) . ')';
        $query = $api . $toSearch;

        $result = (new ConnectElsevier())->askJson($query);

        return $result;

    }

    public function getPubByScopusSearchAuthor($auid, $name, $surname, $afid, $city, $country){
        //TODO
        // AUTHFIRST(j) and AUTHLASTNAME(barney) and AU-ID(100038831) and 
        // AF-ID(3000604) and AFFILCITY(beijing) and AFFILCOUNTRY(japan)
        $query;
        $api = "search/scopus?query=";
        $toSearch = 'ABS(' . urlencode($toSearch) . ')';
        $query = $api . $toSearch;
        $result = $this->getJsonByQuery($query);

        return $result;
    }
    

}
