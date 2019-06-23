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
        $this->model = new DownloadElsevier();
        $this->view = new NanoView();
    }

    public function processRequest() {
        $_SESSION['error'] = array();

        $requestObject = $_REQUEST["object"];

        if ($requestObject !== "search") {
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
            
            default:
                $this->view->display_json_message(400, "URL no requesting any search");
                break;
        }
    }

    public function processGETRequest() {
        if ( filter_has_var(INPUT_GET . 'doi') ) {
            $this->byDoi();

        } 
        if ( filter_has_var(INPUT_GET . 'abstract') ) {
            $this->byAbstract();

        } 
        if ( filter_has_var(INPUT_GET . 'title') ) {
            $this->byTitle();

        }
        if ( filter_has_var(INPUT_GET . 'authors') ) {
            $this->authors();

        }
        if ( filter_has_var(INPUT_GET . 'author') ) {
            $this->ByAuthor();

        }
        else {
            $this->view->display_json_message(400, "URL no requesting any search");
        }
    }

        public function byDoi() {
            // $doi = filter_input(INPUT_GET, 'doi');
            $doi = '2';
            $pub = $this->model->byIdentifier($doi);
            if ( empty($_SESSION['error']) ) {
                if( !empty($pub) ) {
                    $this->view->display_json($pubs);
                } else {
                    $this->view->display_json_message( 404, PubMessage::ERR_FORM['not_found'] );
                }
            } else {
                $this->view->display_json_message(503, $_SESSION['error'] );
            }
        }

        public function byAbstract() {
            // $abstract = filter_input(INPUT_GET, 'abstract');
            $abstract = '2';
            $pubs = $this->model->byAbstract($abstract);
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

        public function byTitle() {
            // $title = filter_input(INPUT_GET, 'title');
            $title = '2';
            $pubs = $this->model->byTitle($title);
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

        public function authors() {
            // $title = filter_input(INPUT_GET, 'author');
            $author = '2';
            $authors = $this->model->authors($author);
            if ( empty($_SESSION['error']) ) {
                if( !empty($authors) ) {
                    $this->view->display_json($authors);
                } else {
                    $this->view->display_json_message( 404, PubMessage::ERR_FORM['not_found'] );
                }
            } else {
                $this->view->display_json_message(503, $_SESSION['error'] );
            }
        }

        public function ByAuthor() {
            // $title = filter_input(INPUT_GET, 'author');
            $author = '2';
            $pubs = $this->model->ByAuthor($author);
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
