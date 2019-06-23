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
            case "POST": // add
                $this->processPOSTRequest();
                break;

            default:
                $this->view->display_json_message(400, "URL no requesting publication");
                break;
        }
    }

    

        
        
        
    
    public function processPOSTRequest() {
        if (filter_has_var(INPUT_POST, 'mail') && filter_has_var(INPUT_POST, 'password')) {
            $this->login();

        } elseif (filter_has_var(INPUT_POST, 'user')) {
            $this->registration();

        } else {
            $this->view->display_json_message(400, "URL no requesting any resource");

        }

    }

    public function login() {
        // TODO
        $id = filter_var($_REQUEST["id"]);
        //valida from POST data
        $pubValid = UserFormValidation::checkData(UserFormValidation::LOGIN_FIELDS);

        if (!empty($_SESSION['error'])) { //empty or invalid values  - 400 - Bad Request
            $this->view->display_json_message(400, $_SESSION['error']);
            return;
        }


        // check if user exists
        $pub = $this->model->searchById($pubValid->getId());

        if (!is_null($pub)) {
            $this->view->display_json_message(400, PubMessage::ERR_FORM['exists_id']);
            return;
        }


        $logged = $this->model->add($pubValid);
        if ($logged) {
            $this->view->display_json_message(201, PubMessage::INF_FORM['insert']);
        } else {
            $this->view->display_json_message(503, $_SESSION['error']);
        }
    }



 

}
