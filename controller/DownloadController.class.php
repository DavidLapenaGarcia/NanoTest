<?php

require_once "view/DownloadView.class.php";
require_once "DownloadElsevier/DownloadElsevier.class.php";
require_once "util/DownloadMessage.class.php";

class DownloadController {
    private $view;
    private $dAPI;

    public function __construct() {
        $this->view = new DownloadView();
        $this->dAPI = new DownloadElsevier();
    }
    public function processRequest() {

        $request = NULL;
        $_SESSION['info'] = array();
        $_SESSION['error'] = array();
        $_SESSION['publication'] = NULL;

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

                case "by_author_form":   //search authors
                        $this->toAuthorForm();
                    break;
                case "by_author":          // Choose author
                        $this->byAuthor();
                    break;
                
                case "download_pub":
                        $this->download();
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
            $_SESSION['publication'] = $result; 
            $content = array_merge($content, array("result"=>$result));
        } else {
            $_SESSION['publication'] = NULL; 
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
      //var_dump($result);
        if(!is_null($result)) {
            $_SESSION['publication'] = $result;
            $content = array_merge($content, array("result"=>$result));
        } else {
            $_SESSION['publication'] = NULL;
            array_push($_SESSION['error'], "Fail on Download Controller / byAbstract");
        } 
        
        $this->view->display("view/form/Download/AbstractForm.php", $content);
    }



    public function toAuthorForm() {
        $auid = trim(filter_input(INPUT_POST, 'auid'));
        $name = trim(filter_input(INPUT_POST, 'name'));
        $surname = trim(filter_input(INPUT_POST, 'surname'));
        $afid = trim(filter_input(INPUT_POST, 'afid'));
        $city = trim(filter_input(INPUT_POST, 'city'));
        $country = trim(filter_input(INPUT_POST, 'country'));
        
        $content = array(
            "auid" =>$auid,
            "name" =>$name,
            "surname" =>$surname,
            "afid" =>$afid,
            "city" =>$city,
            "country" =>$country
        );

        $this->view->display("view/form/Download/AuthorForm.php", $content);
    }
    public function byAuthor() {
        //TODO: validations
        $auid = trim(filter_input(INPUT_POST, 'auid'));
        $name = trim(filter_input(INPUT_POST, 'name'));
        $surname = trim(filter_input(INPUT_POST, 'surname'));
        $afid = trim(filter_input(INPUT_POST, 'afid'));
        $city = trim(filter_input(INPUT_POST, 'city'));
        $country = trim(filter_input(INPUT_POST, 'country'));
        
        $content = array(
            "auid" =>$auid,
            "name" =>$name,
            "surname" =>$surname,
            "afid" =>$afid,
            "city" =>$city,
            "country" =>$country
        );
        $result="there is no credentials for use /search/author";
        // Here we need /search/author 
        // $result = $this->dAPI->byAuthor($auid, $name, $surname, $afid, $city, $country);

        if(!is_null($result)) {
            $content = array_merge($content, array("result"=>$result));
        } else {
            array_push($_SESSION['error'], "Fail on ElsevierController");
        } 
        
        $this->view->display("view/form/Download/AuthorForm.php", $content);
    }

    public function download() {
        $toSearch = trim(filter_input(INPUT_POST, 'to-search'));
        $searchAs = "doi";
        $pub = $this->dAPI->byIdentifier($toSearch, $searchAs);

        

    }




}