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
            case "GET":  // list, update
                $this->processGETRequest();
                break;
            
            case "POST": // add
                $this->processPOSTRequest();
                break;

            case "PUT": // modify
                $this->processPUTRequest();
                break;

            case "DELETE": //delete
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

        }if ( filter_has_var(INPUT_GET . 'pubId') ) {
            $this->updatePub();
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
        public function updatePub() {
            // $pubId = filter_input(INPUT_GET, 'pubId');
            $pubId = '2';
            $result = $this->model->update($pubId);
            if ( empty($_SESSION['error']) ) {
                if( !is_null($result) ) {
                    $this->view->display_json($result);
                } else {
                    $this->view->display_json_message( 404, PubMessage::ERR_FORM['not_found'] );
                }
            } else {
                $this->view->display_json_message(503, $_SESSION['error'] );
            }
        }
    
    public function processPOSTRequest() {

        //valida from POST data
        $pubValid = PubFormValidation::checkData(PubFormValidation::ADD_FIELDS);

        if (!empty($_SESSION['error'])) { //empty or invalid values  - 400 - Bad Request
            $this->view->display_json_message(400, $_SESSION['error']);
            return;
        }


        // check if pub exists
        $pub = $this->model->searchById($pubValid->getId());

        if (!is_null($pub)) {
            $this->view->display_json_message(400, PubMessage::ERR_FORM['exists_id']);
            return;
        }


        $added = $this->model->add($pubValid);
        if ($added) {
            $this->view->display_json_message(201, PubMessage::INF_FORM['insert']);
        } else {
            $this->view->display_json_message(503, $_SESSION['error']);
        }
    }

    public function processPUTRequest() {
        // get PUT data   // x-www-form-urlencoded
        parse_str(file_get_contents("php://input"), $put_vars);

        //check data
        if (array_key_exists("pubId", $put_vars)) {
            PubFormValidation::checkId($put_vars["pubId"]);
        }
        if (array_key_exists("doi", $put_vars)) {
            PubFormValidation::checkDoi($put_vars["doi"]);
        }
        if (array_key_exists("title", $put_vars)) {
            PubFormValidation::checkTitle($put_vars["title"]);
        }
        if (array_key_exists("abstract", $put_vars)) {
            PubFormValidation::checkAbstract($put_vars["abstract"]);
        }
        if (array_key_exists("author", $put_vars)) {
            PubFormValidation::checkAuthor($put_vars["author"]);
        }
        if (array_key_exists("pubType", $put_vars)) {
            PubFormValidation::checkPubType($put_vars["pubType"]);
        }
        if (array_key_exists("linkWeb", $put_vars)) {
            PubFormValidation::checkLinkWeb($put_vars["linkWeb"]);
        }
        if (array_key_exists("linkDownload", $put_vars)) {
            PubFormValidation::checkLinkDownload($put_vars["linkDownload"]);
        }
        if (array_key_exists("jsonRetieval", $put_vars)) {
            PubFormValidation::checkJsonRetieval($put_vars["jsonRetieval"]);
        }
        if (array_key_exists("jsonCrossref", $put_vars)) {
            PubFormValidation::checkJsonCrossref($put_vars["jsonCrossref"]);
        }
        if (array_key_exists("jsonArticle", $put_vars)) {
            PubFormValidation::checkJsonArticle($put_vars["jsonArticle"]);
        }
        if (array_key_exists("jsonScopus", $put_vars)) {
            PubFormValidation::checkJsonScopus($put_vars["jsonScopus"]);
        }
        if (array_key_exists("authors", $put_vars)) {
            PubFormValidation::checkAuthors($put_vars["authors"]);
        }
        if (array_key_exists("keywords", $put_vars)) {
            PubFormValidation::checkKeywords($put_vars["keywords"]);
        }
        if (!empty($_SESSION['error'])) { //empty or invalid values  - 400 - Bad Request
            $this->view->display_json_message(400, $_SESSION['error']);
            return;
        }
        $pubValid = new Publication($put_vars["pubId"],         $put_vars["name"],          $put_vars["doi"],
                                    $put_vars["title"],         $put_vars["abstract"],      $put_vars["author"],
                                    $put_vars["pubType"],       $put_vars["linkWeb"],       $put_vars["linkDownload"],
                                    $put_vars["jsonRetieval"],  $put_vars["jsonCrossref"],  $put_vars["jsonArticle"],
                                    $put_vars["jsonScopus"],    $put_vars["authors"],       $put_vars["keywords"] );
        
        
        // check if pub exists
        $pub = $this->model->searchById($pubValid->getId());
        if (!is_null($pub)) {
            $this->view->display_json_message(400, PubMessage::ERR_FORM['exists_id']);
            return;
        }


        $modified = $this->model->modify($pubValid);
        if ($modified) {
            $this->view->display_json_message(200, PubMessage::INF_FORM['update']);
        } else {
            $this->view->display_json_message(503, $_SESSION['error']);
        }
    }

    public function processDELETERequest() {
        //get URL parameters for DELETE   
       $pubId = filter_var($_REQUEST["pubId"]);
       
       PubFormValidation::checkId($pubId);
       if (!empty($_SESSION['error'])) { //empty or invalid values  - 400 - Bad Request
           $this->view->display_json_message(400, $_SESSION['error']);
           return;
       }
       

       $pub = $this->model->searchById($id);
       if (is_null($pub)) {
           $this->view->display_json_message(404, PubMessage::ERR_FORM['not_exists_id']);
           return;
       }
       

       $deleted = $this->model->delete($id);
       if ($deleted) {
           $this->view->display_json_message(200, PubMessage::INF_FORM['delete']);
       } else {
           $this->view->display_json_message(503, $_SESSION['error']);
       }
   }



 

}
