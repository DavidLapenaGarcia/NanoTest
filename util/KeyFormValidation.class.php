<?php


class KeyFormValidation {

    const ADD_FIELDS    = array('totem', 'contented');
    const MODIFY_FIELDS = array('keyWordId', 'totem', 'contented');
    const DELETE_FIELDS = array('keyWordId');
    const SEARCH_FIELDS = array('keyWordId');
    const NUMERIC = "/[^0-9]/";
    //const ALPHABETIC = "/[^a-z A-Z]/";

    public static function checkData($fields) {
        $keyWordId= NULL; 
        $totem = NULL;
        $contented= NULL;

        foreach ($fields as $field) {
            switch ($field) {
                case 'keyWordId': 
                    $keyWordId=trim(filter_input(INPUT_POST, 'keyWordId'));
                    $idValid=!preg_match(self::NUMERIC, $keyWordId);
                    if(is_numeric($keyWordId)) {
                        $keyWordId = (int) $keyWordId;
                    }
                    if (empty($keyWordId)) {
                        array_push($_SESSION['error'], PubMessage::ERR_FORM['empty_id']);
                    }
                    else if ($idValid == FALSE) {
                        array_push($_SESSION['error'], PubMessage::ERR_FORM['invalid_id']);
                    }
                    break;

                case 'totem': 
                // TODO : 
                    $totem = trim(filter_input(INPUT_POST, 'totem'));
                    $totemValid = filter_var($totem, FILTER_SANITIZE_STRING);
                    if (empty($totem)) {
                        array_push($_SESSION['error'], PubMessage::ERR_FORM['empty_totem']);
                    } else if ($totemValid == FALSE) {
                        array_push($_SESSION['error'], PubMessage::ERR_FORM['invalid_totem']);
                    }
                    break;

                case 'contented': 
                // TODO : 
                    $contented = trim(filter_input(INPUT_POST, 'contented'));
                    $contentedValid = filter_var($contented, FILTER_SANITIZE_STRING);
                    if (empty($contented)) {
                        array_push($_SESSION['error'], PubMessage::ERR_FORM['empty_doi']);
                    } else if ($contentedValid == FALSE) {
                        array_push($_SESSION['error'], PubMessage::ERR_FORM['invalid_doi']);
                    }
                    break;
                
                
                case 'xx':  
                // TODO : 
                    $doi = trim(filter_input(INPUT_POST, 'doi'));
                    $doiValid = filter_var($doi, FILTER_SANITIZE_STRING);
                    if (empty($doi)) {
                        array_push($_SESSION['error'], UserMessage::ERR_FORM['empty_doi']);
                    } else if ($doiValid == FALSE) {
                        array_push($_SESSION['error'], UserMessage::ERR_FORM['invalid_doi']);
                    }
                    break;
            }
        }
        // FIX IT.. ?

        $keyw = new Keyword( $keyWordId, $totem, $contented);
        $keyw->setId($keyWordId);
        $keyw->setTotem($totem);
        $keyw->setContented($contented);
        return $keyw;
    }

}
