<?php

require_once "model/PublicationModel.class.php";
require_once "model/Publication.class.php";
require_once "view/NanoView.class.php";
require_once "util/PubMessage.class.php";
require_once "util/PubFormValidation.class.php";

class ServicePublicationController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new PublicationModel();
        $this->view = new NanoView();
    }

    public function processRequest() {
        $_SESSION['error'] = array();

        $requestObject = $_REQUEST["object"];

        if ($requestObject !== "publication") {
            //var_dump('no requesting publication: ' . $requestObject);
            $this->view->display_json_message(400, 'URL no requesting publication ');
            return;
        }

        $http_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
        $this->view->display_json($pubs);
        
        switch ($http_method) {
            case "GET":
                $this->processGETRequest();
                break;
            
            case "POST":
                $this->processPOSTRequest();
                break;

            case "PUT":
                $this->processPUTRequest();
                break;

            case "DELETE":
                $this->processDELETERequest();
                break;
            
            default:
                $this->view->display_json_message(400, "URL no requesting publication");
                break;
        }
    }

    public function processGETRequest() {
        if ( filter_has_var(INPUT_GET . 'userId') ) {
            $this->listUserPubs();

        } else {
            //$this->listUserPubs();
            $this->listAll();
        }
    }

        public function listAll() {
            // FIXME: Get user's Id
            $userId = '2';
            $pubs = $this->model->listAll($userId);
            if ( empty($_SESSION['error']) ) {
                if( !empty($pubs) ) {
                    $this->view->display_json($pubs);
                } else {
                    $this->view->display_json_message( 404, PubMessage::ERR_FORM['not_found'] );
                }
            } else {
                $this->view->display_json_message(503, $_SESSION['error'] );
            }
        }

        public function listUserPubs() {
            // $userId = filter_input(INPUT_GET, 'userId');
            $userId = '2';
            $pubs = $this->model->listUserPubs($userId);
            if ( empty($_SESSION['error']) ) {
                if( !empty($pubs) ) {
                    $this->view->display_json($pubs);
                } else {
                    $this->view->display_json_message( 404, PubMessage::ERR_FORM['not_found'] );
                }
            } else {
                $this->view->display_json_message(503, $_SESSION['error'] );
            }
        }



 

}
