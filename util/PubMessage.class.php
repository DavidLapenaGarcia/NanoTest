<?php

class PubMessage {

    const INF_FORM =
        array(
            'insert' => 'Data inserted successfully',
            'update' => 'Data updated successfully',
            'delete' => 'Data deleted successfully',
            'found'  => 'Data found',
            '' => ''
        );
    
    const ERR_FORM =
        array(
            'invalid_id'  => 'Id  must be filled',
            'empty_doi'      => 'DOI must be filled',
            'empty_title'    => 'DOI must be filled',
            'empty_abstract'  => 'abstract must be filled',
            'empty_author'  => 'author must be filled',
            'empty_pubType'  => 'pubType must be filled',
            'empty_linkWeb'  => 'LinkWeb must be filled',
            'empty_linkDownload'  => 'LinkDownload must be filled',
            'empty_jsonRetrieval'  => 'jsonRetrieval must be filled',
            'empty_jsonCrossRef'  => 'jsonCrossRef must be filled',
            'empty_jsonArticle'  => 'jsonArticle  must be filled',
            'empty_jsonScopus'  => 'jsonScopus must be filled',

            'invalid_id'  => 'Id must be valid values',
            'invalid_doi'    => 'Password must be valid values',
            'invalid_title'  => 'title must be valid values',
            'invalid_abstract'  => 'abstract must be valid values',
            'invalid_author'  => 'author must be valid values',
            'invalid_pubType'  => 'pubType must be valid values',
            'invalid_linkWeb'  => 'LinkWeb must be valid values',
            'invalid_linkDownload'  => 'LinkDownload must be valid values',
            'invalid_jsonRetrieval'  => 'jsonRetrieval must be valid values',
            'invalid_jsonCrossRef'  => 'jsonCrossRef must be valid values',
            'invalid_jsonArticle'  => 'jsonArticle  must be valid values',
            'invalid_jsonScopus'  => 'jsonScopus must be valid values',


            'exists_id'     => 'ID already exists',
            'exists_doi'    => 'DOI already exists',

            'not_exists_doi' => 'Doi not exists',
            
            'not_modify_doi' => 'DOI cannot be modify', 

            'not_a_number'    => 'Age must be valid values',
            'not_a_string'    => 'Description must be valid values',

            'not_found'     => 'No data found',
            '' => ''
        );

    const ERR_DAO =
        array(
            'not_found' => 'Error not found',
            'insert' => 'Error inserting data',
            'update' => 'Error updating data',
            'delete' => 'Error deleting data',
            'used'   => 'Can not be deleted',
            '' => ''
        );
    
}