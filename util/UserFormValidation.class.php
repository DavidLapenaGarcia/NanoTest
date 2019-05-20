<?php

/**
 * Clase de validación
 * En el caso de age, permite validar como ok si el age es vacío, porque es un
 * valor opcional.
 * Solo validamos que los campos string lo sean y que en caso de usarse el campo
 * age, que sea un string
 */
class UserFormValidation {

    const ADD_FIELDS = array('name', 'password', 'mail');
    const MODIFY_FIELDS = array('userId', 'name', 'password', 'mail');
    const DELETE_FIELDS = array('userId');
    const SEARCH_FIELDS = array('userId');
    //const NUMERIC = "/[^0-9]/";
    //const ALPHABETIC = "/[^a-z A-Z]/";

    public static function checkData($fields) {
        $userId = NULL;
        $name = NULL;
        $password = NULL;
        $mail = NULL;

        foreach ($fields as $field) {
            switch ($field) {
                case 'userId':  
                    $userId = trim(filter_input(INPUT_POST, 'userId'));
                    $userIdValid = filter_var($userId, FILTER_SANITIZE_STRING);
                    if (empty($userId)) {
                        array_push($_SESSION['error'], UserMessage::ERR_FORM['empty_id']);
                    } else if ($userIdValid == FALSE) {
                        array_push($_SESSION['error'], UserMessage::ERR_FORM['invalid_id']);
                    }
                    break;
                case 'name':  
                    $name = trim(filter_input(INPUT_POST, 'name'));
                    $nameValid = filter_var($name, FILTER_SANITIZE_STRING);
                    if (empty($name)) {
                        array_push($_SESSION['error'], UserMessage::ERR_FORM['empty_name']);
                    } else if ($nameValid == FALSE) {
                        array_push($_SESSION['error'], UserMessage::ERR_FORM['invalid_name']);
                    }
                    break;
                case 'password':
                    $password = trim(filter_input(INPUT_POST, 'password')); 
                    $passwordValid = filter_var($password, FILTER_SANITIZE_STRING);
                    if (empty($password)) {
                        array_push($_SESSION['error'], UserMessage::ERR_FORM['empty_password']);
                    } else if ($passwordValid == FALSE) {
                        array_push($_SESSION['error'], UserMessage::ERR_FORM['invalid_password']);
                    }
                    break;
                case 'mail':
                    $mail = trim(filter_input(INPUT_POST, 'mail')); 
                    $mailValid = filter_var($mail, FILTER_SANITIZE_STRING);
                    if (empty($mail)) {
                        array_push($_SESSION['error'], UserMessage::ERR_FORM['empty_mail']);
                    } else if ($mailValid == FALSE) {
                        array_push($_SESSION['error'], UserMessage::ERR_FORM['invalid_mail']);
                    }
                    break;
                case 'xx':
                    $userId = trim(filter_input(INPUT_POST, 'mail'));
                    $userIdValid = filter_var($userId, FILTER_SANITIZE_STRING);
                    if ($userIdValid == FALSE) {
                        array_push($_SESSION['error'], UserMessage::ERR_FORM['invalid_id']);
                    }
                    break;
            }
        }

        $user = new User($userId,$name, $password, $mail);

        return $user;
    }

}
