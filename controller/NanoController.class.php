<?php
require_once "view/NanoView.class.php";
require_once "model/Publication.class.php";
require_once "model/PublicationModel.class.php";
require_once "util/PubMessage.class.php";
require_once "util/PubFormValidation.class.php";

class NanoController {
    private $view;
    private $pModel;

    public function __construct() {
        $this->view = new NanoView();
        $this->pModel = new PublicationModel();
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
                case "list_all":
                    $this->listAllPubs();
                    break;
                case "add_pub_form":
                    $this->toAddPub();
                    break;
                case "add_pub":
                    $this->addPub();
                    break;
                case "search_pub":
                    $this->searchByDoi();
                    break;
                case "detail_pub":
                    $this->searchByDoi();
                    break;
                case "update_pub":
                    $this->updatePub();
                    break;
                case "delete_pub":
                    $this->deletePub();
                    break;
            /*    
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
                case "list_all":
                $this->listAllKeys();
                break;
                case "add_key_form":
                    $this->toAddKey();
                    break;
                case "add_key":
                    $this->addKey();
                    break;
                case "search_keys":
                    $this->searchKeys();
                    break;
                case "detail_key":
                    $this->searchByKey();
                    break;
                case "update_key":
                    $this->updateKey();
                    break;
                case "delete_key":
                    $this->deleteKey();
                    break;
            
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
        $pubs = $this->pModel->listAll();
        if (empty($_SESSION['error'])){
            if(!empty($pubs)) {
                $_SESSION['info'] = UserMessage::INF_FORM['found'];
            }else{
                $_SESSION['info'] = UserMessage::ERR_FORM['not_found'];
            }
        }
        $this->view->display("view/form/Nano/PubsList.php", $pubs);
    }

    public function toAddPub() {

        /* $pub_id= trim(filter_input(INPUT_POST, 'pub_id')); 
        $doi = trim(filter_input(INPUT_POST, 'doi'));
        $title= trim(filter_input(INPUT_POST, 'title'));;
        $abstract= trim(filter_input(INPUT_POST, 'abstract'));;
        $authors= trim(filter_input(INPUT_POST, 'authors'));;
        $pubType= trim(filter_input(INPUT_POST, 'pubType'));;
        $linkWeb= trim(filter_input(INPUT_POST, 'linkWeb'));;
        $linkDownload= trim(filter_input(INPUT_POST, 'linkDownload'));;
        $jsonRetrieval= trim(filter_input(INPUT_POST, 'jsonRetrieval'));;
        $jsonCrossRef= trim(filter_input(INPUT_POST, 'jsonCrossRef'));;
        $jsonArticle= trim(filter_input(INPUT_POST, 'jsonArticle'));;
        $jsonScopus= trim(filter_input(INPUT_POST, 'jsonScopus'));;

        $content = array(
            "pub_id" =>$pub_id,               
            "doi" => $doi ,
            "title" => $title,
            "abstract" => $abstract,
            "authors" => $authors,
            "pubType" => $pubType,
            "linkWeb" => $linkWeb,
            "linkDownload" => $linkDownload,
            "jsonRetrieval" => $jsonRetrieval,
            "jsonCrossRef" => $jsonCrossRef,
            "jsonArticle" => $jsonArticle,
            "jsonScopus" => $jsonScopus
        ); */
        $this->view->display("view/form/Nano/AddForm.php", $content);
    }

    public function searchByDoi() {
        $content=PubFormValidation::checkData(PubFormValidation::SEARCH_FIELDS);
        
        if (empty($_SESSION['error'])) {
            $pub=$this->pModel->search($content->getDoi());

            if (!is_null($pub)) {
                $_SESSION['info']=PubMessage::INF_FORM['found'];
                // ADD AUTHORS, KEYSW
                $content=$pub;
            }
            else {
                $_SESSION['error']=PubMessage::ERR_FORM['not_found'];
            }
        }
        
        $this->view->display("view/form/Nano/AddForm.php", $content);
    }

    public function addPub() {
        
        $pubValid = PubFormValidation::checkData(PubFormValidation::ADD_FIELDS); 
        if (empty($_SESSION['error'])) {
            $pub = $this->pModel->search($pubValid->getDoi());
            

            if (is_null($pub)) {
                $result=$this->pModel->add($pubValid);
                
                if ($result == TRUE) {
                    $_SESSION['info']=PubMessage::INF_FORM['insert'];
                    $pubValid=NULL;
                }
            }
            else {
                $_SESSION['error']=PubMessage::ERR_FORM['exists_doi'];          
            } 
        }
        $pubValid = $pubValid;
        $this->view->display("view/form/Nano/AddForm.php", $pubValid);
    }

    public function deletePub() {
        $pubValid=PubFormValidation::checkData(PubFormValidation::DELETE_FIELDS);
        
        if (empty($_SESSION['error'])) {
            $pub=$this->pModel->search($pubValid->getDoi());

            if (!is_null($pub)) {            
                $result=$this->pModel->delete($pub->getId());

                if ($result == TRUE) {
                    $_SESSION['info']=PubMessage::INF_FORM['delete'];
                    $pubValid=NULL;
                }
            }
            else {
                $_SESSION['error']=PubMessage::ERR_FORM['not_exists_doi'];
            }
        }
        
        //$this->view->display("view/form/Nano/AddForm.php");
        $this->listAllPubs();
        
    }

    public function updatePub() {
        $pubValid=PubFormValidation::checkData(PubFormValidation::MODIFY_FIELDS);

        if (empty($_SESSION['error'])) {
            if (!is_null($pubValid)) {    
                $result=$this->pModel->update($pubValid);

                if ($result == TRUE) {
                    $_SESSION['info']=PubMessage::INF_FORM['delete'];
                    $pubValid=NULL;
                }
            } else {
                $_SESSION['error']=PubMessage::ERR_FORM['not_exists_id'];
            }
        }
        
        //$this->view->display("view/form/Nano/AddForm.php");
        $this->listAllPubs();
        
    }




    public function logout() {
        session_destroy();
        header("Location: index.php");
    }






}