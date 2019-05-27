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

                case "to_user_form":
                    $this->toUserForm();
                    break;
                case "add_user":
                    $this->addUser();
                    break;
                case "delete_user":
                    $this->deleteUser();
                    break;
                case "modify_user":
                    $this->updateUser();
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
        $userValid = new User(  NULL,
                                trim(filter_input(INPUT_POST, 'name')),
                                trim(filter_input(INPUT_POST, 'password')),
                                NULL
                            );
       // var_dump($userValid);                    
        $user = $this->model->searchValid($userValid->getName(), $userValid->getPassword());
        $this->view->display("view/form/UserForm.php");
        
        if (!is_null($user) && ($userValid->getPassword() == $user->getPassword())) {
            $_SESSION['name'] = $user->getName();
            $_SESSION['user'] = serialize($user);
        }
        header("Location: index.php");
        //$this->view->display("view/form/LoginForm.php");                    
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
        $content = NULL;
        $userValid=UserFormValidation::checkData(UserFormValidation::SEARCH_FIELDS);
        var_dump($userValid);
        if (empty($_SESSION['error'])) {
            $user=$this->model->searchById($userValid->getId());

            if (!is_null($user)) {
                $_SESSION['info']=UserMessage::INF_FORM['found'];
                $content=$user;
            }
            else {
                $_SESSION['error']=UserMessage::ERR_FORM['not_found'];
            }
        }
        var_dump($content);
        $this->view->display("view/form/UserForm.php", $content);
    }

    public function toUserForm($content=NULL) {
        $this->view->display("view/form/UserForm.php", $content);
    }

    public function addUser() {
        $userValid = UserFormValidation::checkData(UserFormValidation::ADD_FIELDS); 

        if (empty($_SESSION['error'])) {
            $user = $this->model->searchById($userValid->getId());
            if (is_null($user)) {
                $result=$this->model->add($userValid);
                
                if ($result == TRUE) {
                    $_SESSION['info']=UserMessage::INF_FORM['insert'];
                    $userValid=NULL;
                }
            }
            else {
                $_SESSION['error']=UserMessage::ERR_FORM['exists_id'];          
            } 
        }
        $this->listAll();
    }

    public function deleteUser() {
        $content=UserFormValidation::checkData(UserFormValidation::DELETE_FIELDS);
        
        if (empty($_SESSION['error'])) {
            $user=$this->model->searchById($content->getId());

            if (!is_null($user)) {            
                $result=$this->model->delete($user->getId());

                if ($result == TRUE) {
                    $_SESSION['info']=UserMessage::INF_FORM['delete'];
                    $content=NULL;
                }
            }
            else {
                $_SESSION['error']=UserMessage::ERR_FORM['not_exists_id'];
            }
        }
        
        $this->view->display("view/form/UserForm.php",$content);
    }

    public function updateUser() {
        $content=UserFormValidation::checkData(UserFormValidation::MODIFY_FIELDS);

        if (empty($_SESSION['error'])) {
            if (!is_null($content)) {    
                $result=$this->model->update($content);

                if ($result == TRUE) {
                    $_SESSION['info']=UserMessage::INF_FORM['update'];
                    $content=NULL;
                }
            } else {
                $_SESSION['error']=UserMessage::ERR_FORM['not_exists_id'];
            }
        }
        
        //$this->view->display("view/form/Nano/AddForm.php");
        $this->view->display("view/form/UserForm.php",$content);
        
    }


    public function logout() {
        session_destroy();
        header("Location: index.php");
    }






}