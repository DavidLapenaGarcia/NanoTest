<?php
require_once "controller/ws/ServicePublicationController.class.php";

class ServiceMainController {
    public function processRequest() {
        $requestObject = $_REQUEST["object"];

        switch ($requestObject) {
            case "publication":
            //http://10.0.2.15/nanoTest/service.php?object=publication&option=list/list
                var_dump('ServiceMainController/publication');
                $controlServicePublication = new ServicePublicationController();
                $controlServicePublication->processRequest();
                break;

            case "search":
                var_dump('ServiceMainController/search');
                $controlServicePublication = new ServicePublicationController();
                $controlServicePublication->processRedquest();
                break;

            case "users":
                var_dump('ServiceMainController/users');
                $controlServicePublication = new ServicePublicationController();
                $controlServicePublication->processRedquest();
                break;
                
            default:
                var_dump('ServiceMainController/default');
                $controlServicePublication = new ServicePublicationController();
                $controlServicePublication->processRequest();
                break;
        }
    }
}