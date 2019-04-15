<?php
class UserView {

    public function __construct() {

    }

    public function display($template=NULL, $content=NULL) {
        if (isset($_SESSION['name'])) {
            include("view/menu/MainMenu.html");
        }

        if(!empty($template)) {
            include($template);
        }

        include("view/form/MessagesForm.php");
    }

}
