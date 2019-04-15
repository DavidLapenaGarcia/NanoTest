<?php
class ConnectApi {
    
    public function __consrtuct() {

    }

    public function getUrl():string {
        $url="https://api.elsevier.com/content/";
        return $url;
    }
    public function getApiKey():string {
        $key="8932ae370b77efdfd90cbe1e78f27211";
        $apiKey = '?apiKey='. $key;
        return $apiKey;
    }
}

/**
 * Mine: 
https://api.elsevier.com/content/abstract/doi?10.1016/S0014-5793(01)03313-0?apiKey=8932ae370b77efdfd90cbe1e78f27211
 *elsevier:
https://api.elsevier.com/content/abstract/doi/10.1016/S0014-5793(01)03313-0?apiKey=7f59af901d2d86f78a1fd60c1bf9426a
 */