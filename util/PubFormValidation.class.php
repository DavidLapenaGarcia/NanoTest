<?php


class PubFormValidation {

    const ADD_FIELDS    = array('doi', 'title', 'abstract', 'authors', 'pubType', 'linkWeb', 'linkDownload',
                                'jsonRetrieval', 'jsonCrossRef', 'jsonArticle', 'jsonScopus');
    const MODIFY_FIELDS = array('doi', 'title', 'abstract', 'authors', 'pubType', 'linkWeb', 'linkDownload',
                                'jsonRetrieval', 'jsonCrossRef', 'jsonArticle', 'jsonScopus');
    const DELETE_FIELDS = array('doi');
    const SEARCH_FIELDS = array('doi');
    //const NUMERIC = "/[^0-9]/";
    //const ALPHABETIC = "/[^a-z A-Z]/";

    public static function checkData($fields) {
        $pub_id= NULL; 
        $doi = NULL;
        $title= NULL;
        $abstract= NULL;
        $authors= NULL;
        $pubType= NULL;
        $linkWeb= NULL;
        $linkDownload= NULL;
        $jsonRetrieval= NULL;
        $jsonCrossRef= NULL;
        $jsonArticle= NULL;
        $jsonScopus= NULL;
        foreach ($fields as $field) {
            switch ($field) {
                case 'doi': 
                // TODO : 
                    $doi = trim(filter_input(INPUT_POST, 'doi'));
                    $doiValid = filter_var($doi, FILTER_SANITIZE_STRING);
                    if (empty($doi)) {
                        array_push($_SESSION['error'], PubMessage::ERR_FORM['empty_doi']);
                    } else if ($doiValid == FALSE) {
                        array_push($_SESSION['error'], PubMessage::ERR_FORM['invalid_doi']);
                    }
                    break;

                case 'title': 
                // TODO : 
                    $title = trim(filter_input(INPUT_POST, 'title'));
                    $titleValid = filter_var($title, FILTER_SANITIZE_STRING);
                    if (empty($title)) {
                        array_push($_SESSION['error'], PubMessage::ERR_FORM['empty_doi']);
                    } else if ($titleValid == FALSE) {
                        array_push($_SESSION['error'], PubMessage::ERR_FORM['invalid_doi']);
                    }
                    break;
                
                case 'abstract':  
                    // TODO : 
                        $abstract = trim(filter_input(INPUT_POST, 'abstract'));
                        $abstractValid = filter_var($abstract, FILTER_SANITIZE_STRING);
                        if (empty($abstract)) {
                            array_push($_SESSION['error'], PubMessage::ERR_FORM['empty_doi']);
                        } else if ($abstractValid == FALSE) {
                            array_push($_SESSION['error'], PubMessage::ERR_FORM['invalid_doi']);
                        }
                        break;

                case 'authors':  
                // TODO : 
                    $authors = trim(filter_input(INPUT_POST, 'authors'));
                    $authorsValid = filter_var($authors, FILTER_SANITIZE_STRING);
                    if (empty($authors)) {
                        array_push($_SESSION['error'], PubMessage::ERR_FORM['empty_doi']);
                    } else if ($authorsValid == FALSE) {
                        array_push($_SESSION['error'], PubMessage::ERR_FORM['invalid_doi']);
                    }
                    break;

                case 'pubType':  
                // TODO : 
                    $pubType = trim(filter_input(INPUT_POST, 'pubType'));
                    $pubTypeValid = filter_var($pubType, FILTER_SANITIZE_STRING);
                    if (empty($pubType)) {
                        array_push($_SESSION['error'], PubMessage::ERR_FORM['empty_doi']);
                    } else if ($pubTypeValid == FALSE) {
                        array_push($_SESSION['error'], PubMessage::ERR_FORM['invalid_doi']);
                    }
                    break;

                case 'linkWeb':   
                // TODO : 
                    $linkWeb = trim(filter_input(INPUT_POST, 'linkWeb'));
                    $linkWebValid = filter_var($linkWeb, FILTER_SANITIZE_STRING);
                    if (empty($linkWeb)) {
                        array_push($_SESSION['error'], PubMessage::ERR_FORM['empty_doi']);
                    } else if ($linkWebValid == FALSE) {
                        array_push($_SESSION['error'], PubMessage::ERR_FORM['invalid_doi']);
                    }
                    break;

                case 'linkDownload': 
                // TODO : 
                    $linkDownload = trim(filter_input(INPUT_POST, 'linkDownload'));
                    $linkDownloadValid = filter_var($linkDownload, FILTER_SANITIZE_STRING);
                    if (empty($linkDownload)) {
                        array_push($_SESSION['error'], PubMessage::ERR_FORM['empty_doi']);
                    } else if ($linkDownloadValid == FALSE) {
                        array_push($_SESSION['error'], PubMessage::ERR_FORM['invalid_doi']);
                    }
                    break;
        
                case 'jsonRetrieval': 
                // TODO : 
                    $jsonRetrieval = trim(filter_input(INPUT_POST, 'jsonRetrieval'));
                    $jsonRetrievalValid = filter_var($jsonRetrieval, FILTER_SANITIZE_STRING);
                    if (empty($jsonRetrieval)) {
                        array_push($_SESSION['error'], PubMessage::ERR_FORM['empty_doi']);
                    } else if ($jsonRetrievalValid == FALSE) {
                        array_push($_SESSION['error'], PubMessage::ERR_FORM['invalid_doi']);
                    }
                    break;

                case 'jsonCrossRef':   
                // TODO : 
                    $jsonCrossRef = trim(filter_input(INPUT_POST, 'jsonCrossRef'));
                    $jsonCrossRefValid = filter_var($jsonCrossRef, FILTER_SANITIZE_STRING);
                    if (empty($jsonCrossRef)) {
                        array_push($_SESSION['error'], PubMessage::ERR_FORM['empty_doi']);
                    } else if ($jsonCrossRefValid == FALSE) {
                        array_push($_SESSION['error'], PubMessage::ERR_FORM['invalid_doi']);
                    }
                    break;

                case 'jsonArticle': 
                // TODO : 
                    $jsonArticle = trim(filter_input(INPUT_POST, 'jsonArticle'));
                    $jsonArticleValid = filter_var($jsonArticle, FILTER_SANITIZE_STRING);
                    if (empty($jsonArticle)) {
                        array_push($_SESSION['error'], UserMessage::ERR_FORM['empty_doi']);
                    } else if ($jsonArticleValid == FALSE) {
                        array_push($_SESSION['error'], UserMessage::ERR_FORM['invalid_doi']);
                    }
                    break;

                case 'jsonScopus':  
                // TODO : 
                    $jsonScopus = trim(filter_input(INPUT_POST, 'jsonScopus'));
                    $jsonScopusValid = filter_var($jsonScopus, FILTER_SANITIZE_STRING);
                    if (empty($jsonScopus)) {
                        array_push($_SESSION['error'], UserMessage::ERR_FORM['empty_doi']);
                    } else if ($jsonScopusValid == FALSE) {
                        array_push($_SESSION['error'], UserMessage::ERR_FORM['invalid_doi']);
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

        $pub = new Publication( $pub_id, $doi, $title, $abstract, $authors, $pubType, 
                                $linkWeb, $linkDownload, $jsonRetrieval, $jsonCrossRef, 
                                $jsonArticle, $jsonScopus);

        $pub->setDoi($doi);
        $pub->setTitle($title);
        $pub->setLinkWeb($linkWeb);
        $pub->setLinkDownload($linkDownload);
        $pub->setJsonRetieval($jsonRetrieval);
        $pub->setPubType($pubType);
        $pub->setJsonScopus($jsonScopus);
        $pub->setAbstract($abstract);
        $pub->setJsonArticle($jsonArticle);
        $pub->setAuthors($authors);
        $pub->setJsonCrossref($jsonCrossRef);
        return $pub;
    }

}
