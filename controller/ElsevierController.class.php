<?php

require_once "view/ElsevierView.class.php";
require_once "api/ElsevierApi.class.php";
require_once "util/ElsevierMessage.class.php";

class ElsevierController {
    private $view;
    private $elsevier;

    public function __construct() {
        $this->view = new ElsevierView();
        $this->elsevier = new ElsevierApi();
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
                case "abstract_retrevial_form":
                    $this->abstractRetrevialForm();
                    break;
                case "abstract_retrevial":
                     $this->abstractRetrevial();
                    break;
                
                case "scopus_by_abstract_form":
                    $this->scopusAbstractForm();
                    break;
                case "scopus_by_abstract":
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

                /* TODO 
                case "by_pdf_form":
                    $this->abstractRetrevialForm();
                    break;
                case "by_pdf_form":
                        $this->abstractRetrevial();
                    break;
                */
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


    public function abstractRetrevialForm() {
        $toSearch = trim(filter_input(INPUT_POST, 'to-search'));
        $content = array(
            "toSearch" =>$toSearch
        );
        $this->view->display("view/form/Elsevier/ElsevierDoiForm.php", $content);
    }
    public function abstractRetrevial() {
        //TODO: validations
        $toSearch = trim(filter_input(INPUT_POST, 'to-search'));
        $searchAs = "doi";
        $content = array("toSearch" => $toSearch);

        $result = $this->elsevier->abstractRetrevial($toSearch, $searchAs);

        if(!is_null($result)) {
            $content = array_merge($content, array("result"=>$result));
        } else {
            array_push($_SESSION['error'], "Fail on ElsevierController");
        } 
        
        $this->view->display("view/form/Elsevier/ElsevierDoiForm.php", $content);
    }

    public function scopusAbstractForm() {
        $toSearch = trim(filter_input(INPUT_POST, 'to-search'));
        $content = array(
            "toSearch" =>$toSearch
        );
        $this->view->display("view/form/Elsevier/ElsevierAbstractForm.php", $content);
    }
    public function scopusAbstract() {
        //TODO: validations
        $abstract = trim(filter_input(INPUT_POST, 'abstract'));
        $content = array("abstract" => $abstract);

        $result = $this->elsevier->scopusAbstract($abstract);

        if(!is_null($result)) {
            $content = array_merge($content, array("result"=>$result));
        } else {
            array_push($_SESSION['error'], "Fail on ElsevierController");
        } 
        
        $this->view->display("view/form/Elsevier/ElsevierAbstractForm.php", $content);
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

        $result = $this->elsevier->scopusAbstract($abstract);

        if(!is_null($result)) {
            $content = array_merge($content, array("result"=>$result));
        } else {
            array_push($_SESSION['error'], "Fail on ElsevierController");
        } 
        
        $this->view->display("view/form/Elsevier/ElsevierAbstractForm.php", $content);
    }


}