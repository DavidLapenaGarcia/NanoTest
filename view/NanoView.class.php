<?php
class NanoView {

    public function __construct() {

    }

    public function display($template=NULL, $content=NULL) {
        if (isset($_SESSION['name'])) {
            include("view/menu/MainMenu.html");
        }

        if(!empty($template)) {
            include($template);
        }

        include("view/form/MessagesForm.php");
    }

        //  API REST try
    private function in_accept_header($mime) {
        $headerStringValue = filter_input(INPUT_SERVER, 'HTTP_ACCEPT');
        $acceptMIME = explode(",", $headerStringValue);
        foreach ($acceptMIME as $mimeandquality) {
            $mimeandquality_array = explode(";", $mimeandquality);
            if (in_array($mime, $mimeandquality_array)) {
                return TRUE;
            };
        }
        return FALSE;
    }

    public function display_json($content = NULL) {
        header("Access-Control-Allow-Origin: *");
        /* header("Content-Type: application/json; charset=UTF-8");
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
        header('Access-Control-Allow-Headers: append,delete,entries,foreach,get,has,keys,set,values,Authorization');
 */
        // set response code - 200 OK
        http_response_code(200);
        // show categories data in json format
        //echo('12');
        echo json_encode($content);
    }

    public function display_json_message($responseCode = NULL, $message = NULL) {
        //header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
        header('Access-Control-Allow-Headers: append,delete,entries,foreach,get,has,keys,set,values,Authorization');
;
        // set HTTP response code
        http_response_code($responseCode);
        echo json_encode( array("message" => $message) );
    }

}
