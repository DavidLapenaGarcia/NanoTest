<?php
class ConnectElsevier {
    private $elsevierUrl;
    private $apiKey;

    
    public function __consrtuct() {
        //TODO:  set key user
    }

    public function getUrl():string {
        $url="https://api.elsevier.com/content/";
        return $url;
    }

    public function getApiKey():string {
        // TODO : Asign actual user's apiKey
        // TODO : It needs add token?
        $key="8932ae370b77efdfd90cbe1e78f27211";
        $apiKey = 'apiKey='. $key;
        return $apiKey;
    }

    public function askJson( $query ) {
        $headers = array(   "Accept: application/json",
                            "X-ELS-APIKey: " . $this->apiKey); 
        $ch = curl_init(); 
        curl_setopt($ch,    CURLOPT_URL,               $query);
        curl_setopt($ch,    CURLOPT_CUSTOMREQUEST,     'GET'); 
        curl_setopt($ch,    CURLOPT_RETURNTRANSFER,    1); 
        curl_setopt($ch,    CURLOPT_TIMEOUT,           60); 
        curl_setopt($ch,    CURLOPT_HTTPHEADER,        $headers);
        $data = curl_exec($ch); 

        if (!curl_errno($ch)) { 
            $apiData = $data;
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

/**
 * Querys Examples
 * David's key (without authorization): 
    * https://api.elsevier.com/content/abstract/doi?10.1016/S0014-5793(01)03313-0?apiKey=8932ae370b77efdfd90cbe1e78f27211
 * Elsevier's example kay (without authorization): 
    * https://api.elsevier.com/content/abstract/doi/10.1016/S0014-5793(01)03313-0?apiKey=7f59af901d2d86f78a1fd60c1bf9426a
 */