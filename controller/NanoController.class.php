<?php

require_once "view/NanoView.class.php";
require_once "model/Publication.class.php";
require_once "model/PublicationModel.class.php";
require_once "util/UserMessage.class.php";
require_once "util/UserFormValidation.class.php";

class NanoController {
    private $view;
    private $model;

    public function __construct() {
        $this->view = new NanoView();
        $this->pub = new PublicationModel();
    }
    public function processRequest() {

        $request = NULL;
        $_SESSION['info'] = array();
        $_SESSION['error'] = array();

        if (filter_has_var(INPUT_POST, 'action')) {
            $request = filter_has_var(INPUT_POST, 'action') ? filter_input(INPUT_POST, 'action') : NULL;
        }else{
            $request = filter_has_var(INPUT_GET, 'option') ? filter_input(INPUT_GET, 'option') : NULL;
        }

        if (isset($_SESSION['name'])) {
            switch ($request) {
            // Publication CRUD
                case "add_pub":
                    $this->addPub();
                    break;
                case "list_all":
                    $this->listAllPubs();
                    break;
                
                case "detail_pub":
                    $this->detailPub();
                    break;
            /*  
                case "update_pub":
                    // $this->updatePub();
                    break;
                case "delete_pub":
                    //  $this->list_all();
                    break;
                // Publications Search
                case "search_pub_doi":
                    //  $this->searchPub();
                    break;
            
                case "search_pub_title":
                    //  $this->searchPub();
                    break;
                case "search_pub_abstract":
                    //  $this->searchPub();
                    break;
                case "search_pub_author":
                    //  $this->searchPub();
                    break;
                case "search_pub_words":
                    //  $this->searchPub();
                    break;
                case "search_pub_review":
                    //  $this->searchPub();
                    break;
                // Publication utilities
                case "modify_words":
                    //  $this->listAll();
                    break;
                case "get_citations":
                    //  $this->searchById();
                    break; 
            */
            
                default:
                    $this->view->display();
            }
        } else {
            switch ($request) {
                case "login":
                    $this->login();
                    break;
                default:
                    $this->view->display("view/form/LoginForm.php");
            }
        }
    }

    public function listAllPubs() {
        $pubs = $this->pub->listAll();
        if (empty($_SESSION['error'])){
            if(!empty($pubs)) {
                $_SESSION['info'] = UserMessage::INF_FORM['found'];
            }else{
                $_SESSION['info'] = UserMessage::ERR_FORM['not_found'];
            }
        }
        $this->view->display("view/form/Nano/PubsList.php", $pubs);
    }

    public function searchById() {
        $userValid=UserFormValidation::checkData(UserFormValidation::SEARCH_FIELDS);
        
        if (empty($_SESSION['error'])) {
            $user=$this->model->searchByName($userValid->getName());

            if (!is_null($user)) {
                $_SESSION['info']=UserMessage::INF_FORM['found'];
                $userValid=$user;
            }
            else {
                $_SESSION['error']=UserMessage::ERR_FORM['not_found'];
            }
        }
        
        $this->view->display("view/form/UserFormModify.php", $userValid);
    }

    public function logout() {
        session_destroy();
        header("Location: index.php");
    }






}