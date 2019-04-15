<?php

require_once "view/UserView.class.php";
require_once "model/UserModel.class.php";
require_once "model/User.class.php";
require_once "util/UserMessage.class.php";
require_once "util/UserFormValidation.class.php";

class UserController {
    private $view;
    private $model;

    public function __construct() {
        $this->view = new UserView();
        $this->model = new UserModel();
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
                case "logout":
                    $this->logout();
                    break;
                case "list_all":
                    $this->listAll();
                    break;
                case "search":
                    $this->searchById();
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

    public function login() {
        $userValid = new User(  trim(filter_input(INPUT_POST, 'name')),
                                trim(filter_input(INPUT_POST, 'password'))
                            );
        $user = $this->model->searchByName($userValid->getName());
        $this->view->display("view/form/UserFormModify.php");
        
        if (!is_null($user) && ($userValid->getPassword() == $user->getPassword())) {
              session_destroy();
            $_SESSION['name'] = $user->getName();
        }
        else if (  trim(filter_input(INPUT_POST, 'name')) == "admin" &&
                    trim(filter_input(INPUT_POST, 'password')) == "admin"){
            $_SESSION['name'] = new User('admin','admin', 22, 'admin', true);
        }
        header("Location: index.php");
                            
    }

    public function listAll() {
        $users = $this->model->listAll();
        if (empty($_SESSION['error'])){
            if(!empty($users)) {
                $_SESSION['info'] = UserMessage::INF_FORM['found'];
            }else{
                $_SESSION['info'] = UserMessage::ERR_FORM['not_found'];
            }
        }
        $this->view->display("view/form/UsersList.php", $users);
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