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
                case "by_doi_form":
                    $this->formByDoi();
                    break;
                case "by_doi":
                     $this->byDoi();
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


    public function formByDoi() {
        $toSearch = trim(filter_input(INPUT_POST, 'to-search'));
        $content = array(
            "toSearch" =>$toSearch
        );
        $doi = "done1";
        $this->view->display("view/form/ElsevierDoiForm.php", $content);
    }

    public function byDoi() {
        $toSearch = trim(filter_input(INPUT_POST, 'to-search'));
        $searchAs = "doi";

        $content = array("toSearch" => $toSearch);

        $result = $this->elsevier->abstractRetrevial($toSearch, $searchAs);

        if(is_null($result)) {
            $content = array_merge($content, array("result"=>$result));
        } else {
            array_push($_SESSION['error'], "Fail on ElsevierController");
        } 
        
        $this->view->display("view/form/ElsevierDoiForm.php", $content);
    }



}