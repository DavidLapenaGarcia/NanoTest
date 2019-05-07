<?php

require_once "view/DownloadView.class.php";
require_once "DownloadApi/DownloadApi.class.php";
require_once "util/DownloadMessage.class.php";

class DownloadController {
    private $view;
    private $dAPI;

    public function __construct() {
        $this->view = new DownloadView();
        $this->dAPI = new DownloadApi();
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
                case "by_identifier_form":
                    $this->toIdentifierForm();
                    break;
                case "by_identifier":
                     $this->byIdentifier();
                    break;

                
                case "by_abstract_form":
                    $this->abstractForm();
                    break;
                case "by_abstract":
                    $this->byAbstract();
                    break;
                case "dfgh":
                    $this->scopusAbstract();
                    break;
                    

                case "scopus_search_author_form":   //search authors
                    $this->scopusAuthorForm();
                    break;
                case "choose_author_form":          // Choose author
                        $this->abstractRetrevial();
                    break;
                case "scopus_author_works_form":    // Choose author's work[s]
                        $this->abstractRetrevial();
                    break;
                case "scopus_author_work":          // Get author's work[s]
                        $this->abstractRetrevial();
                    break;


                default:
                    $this->view->display();
                    break;
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


    public function toIdentifierForm() {
        $toSearch = trim(filter_input(INPUT_POST, 'to-search'));
        $content = array(
            "toSearch" =>$toSearch
        );
        $this->view->display("view/form/Download/IdentifierForm.php", $content);
    }
    public function byIdentifier() {
        //TODO: validations
        $toSearch = trim(filter_input(INPUT_POST, 'to-search'));
        $searchAs = "doi";
        $content = array("toSearch" => $toSearch);

        $result = $this->dAPI->byIdentifier($toSearch, $searchAs);

        if(!is_null($result)) {
            // ToDo: control if there are more than 1 result.
            $content = array_merge($content, array("result"=>$result));
        } else {
            array_push($_SESSION['error'], "Fail on DownloadController / biIdentifier");
        } 
        
        $this->view->display("view/form/Download/IdentifierForm.php", $content);
    }

    public function abstractForm() {
        $abstract = trim(filter_input(INPUT_POST, 'abstract'));
        $content = array(
            "abstract" =>$abstract
        );
        $this->view->display("view/form/Download/AbstractForm.php", $content);
    }
    public function byAbstract() {
        //TODO: validations

        $abstract = trim(filter_input(INPUT_POST, 'abstract'));
        $content = array("abstract" => $abstract);
        $result = $this->dAPI->byAbstract($abstract);

        if(!is_null($result)) {
            $content = array_merge($content, array("result"=>$result));
        } else {
            array_push($_SESSION['error'], "Fail on Download Controller / byAbstract");
        } 
        
        $this->view->display("view/form/Download/AbstractForm.php", $content);
    }



    public function scopusAuthorForm() {
        $toSearch = trim(filter_input(INPUT_POST, 'to-search'));
        $content = array(
            "toSearch" =>$toSearch
        );
        $this->view->display("view/form/Elsevier/ElsevierAbstractForm.php", $content);
    }
    public function scopusAuthor() {
        //TODO: validations
        $name = trim(filter_input(INPUT_POST, 'name'));
        $name = trim(filter_input(INPUT_POST, 'name'));
        $name = trim(filter_input(INPUT_POST, 'name'));
        $content = array("abstract" => $abstract);

        $result = $this->dAPI->scopusAbstract($abstract);

        if(!is_null($result)) {
            $content = array_merge($content, array("result"=>$result));
        } else {
            array_push($_SESSION['error'], "Fail on ElsevierController");
        } 
        
        $this->view->display("view/form/Elsevier/ElsevierAbstractForm.php", $content);
    }




}