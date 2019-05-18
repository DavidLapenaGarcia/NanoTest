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
            'empty_doi'      => 'DOI must be filled',
            'empty_doi'      => 'DOI must be filled',

            'invalid_password'    => 'Password must be valid values',
            'invalid_name'  => 'name must be valid values',

            'exists_id'     => 'ID already exists',
            'exists_doi'     => 'DOI already exists',

            'not_exists_name' => 'name not exists',
            
            'not_modify_name' => 'name cannot be modify',          
            'not_a_number'    => 'Age must be valid values',
            'not_a_string'    => 'Description must be valid values',
            'invalid_role'    => 'Role must be valid values',
            'invalid_active'    => 'Active must be valid values',
            'not_found'     => 'No data found',
            '' => ''
        );

    const ERR_DAO =
        array(
            'insert' => 'Error inserting data',
            'update' => 'Error updating data',
            'delete' => 'Error deleting data',
            'used'   => 'No data deleted, Category in use',
            '' => ''
        );
    
}