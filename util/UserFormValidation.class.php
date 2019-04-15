<?php

/**
 * Clase de validación
 * En el caso de age, permite validar como ok si el age es vacío, porque es un
 * valor opcional.
 * Solo validamos que los campos string lo sean y que en caso de usarse el campo
 * age, que sea un string
 */
class UserFormValidation {

    const ADD_FIELDS = array('name', 'password');
    const MODIFY_FIELDS = array('name', 'password');
    const DELETE_FIELDS = array('name');
    const SEARCH_FIELDS = array('name');
    //const NUMERIC = "/[^0-9]/";
    //const ALPHABETIC = "/[^a-z A-Z]/";

    public static function checkData($fields) {
        $name = NULL;
        $password = NULL;

        foreach ($fields as $field) {
            switch ($field) {
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
                case 'xx':
                    $name = trim(filter_input(INPUT_POST, 'name'));
                    $nameValid = filter_var($name, FILTER_SANITIZE_STRING);
                    if ($nameValid == FALSE) {
                        array_push($_SESSION['error'], UserMessage::ERR_FORM['invalid_name']);
                    }
                    break;
            }
        }

        $user = new User($name, $password, $age, $role, $active);

        return $user;
    }

}
