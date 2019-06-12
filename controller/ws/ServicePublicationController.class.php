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
        var_dump('in');
        $_SESSION['error'] = array();

        $requestObject = $_REQUEST["object"];

        if ($requestObject !== "publication") {
            var_dump('no requesting publication: ' . $requestObject);
            $this->view->display_json_message(400, 'URL no requesting publication ');
            return;
        }
        var_dump('YES requesting publication');

        $http_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

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
        if ( filter_has_var(INPUT_GET . 'doi') ) {
            var_dump('processGETRequest/userId->LISTALL');
            $this->listUserPubs();

        } else {
            $this->listAll();
        }
    }

    public function listALl() {
        $pubs = $this->model->listAll();

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

    public function searchByDoi() {
        $doi = filter_input(INPUT_GET, 'id');

        PubFormValidation::chcekDoi($doi);

        if (empty( $_SESSION['error'])) {
            $this->view->display_json_message(400, $_SESSION['error']);
            return;
        }

        $pub = $this->model->searchByDoi($doi);

        if ( empty($_SESSION['error']) ) {
            if( !is_null($pub) ) {
                $this->view->display_json($pub);
            } else {
                $this->view->display_json_message(503, $_SESSION['error'] );
            }
        }
    }



 

}
