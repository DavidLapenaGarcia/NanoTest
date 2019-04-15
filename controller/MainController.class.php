<?php
require_once "controller/UserController.class.php";
require_once "controller/ElsevierController.class.php";

class MainController {

    public function processRequest() {

        $request=NULL;

        if ( filter_has_var(INPUT_GET,'menu') ){
            $request = filter_input(INPUT_GET, 'menu');
        }

        $controlLogin = NULL;

        switch ($request){
            case "user":
                $controlLogin = new UserController();
                $controlLogin->processRequest();
                break;
            case "elsevier":
                $controlLogin = new ElsevierController();
                $controlLogin->processRequest();
                break;
            default:
                $controlLogin = new UserController();
                $controlLogin->processRequest();
                break;    
                
        }
    }
}