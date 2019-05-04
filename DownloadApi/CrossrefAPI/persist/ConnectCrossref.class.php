<?php
class ConnectCrossref {
/** Query Example
    *   https://data.crossref.org/10.1002%2Fanie.201601931

    https%3A%2F%2Fdata.crossref.org%2F10.1016%2FS0014-5793%2801%2903313-0
**/    

    public function __consrtuct() {
    }

    public function getUrl():string {
        return "https://data.crossref.org/";
    }

    public function askJson( $query ) {
        $query = urlencode($query);
        $query = "https://data.crossref.org/" . $query;
        
        $headers = array(   "Accept: application/json"); 
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



