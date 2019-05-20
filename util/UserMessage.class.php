<?php

class UserMessage {

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
            'empty_id'      => 'Id must be filled',
            'empty_name'    => 'Name must be filled',
            'empty_password'=> 'Password must be filled',
            'empty_mail'    => 'Mail must be filled',

            'invalid_id'    => 'Id must be valid values',
            'invalid_name'  => 'name must be valid values',
            'invalid_password'    => 'Password must be valid values',
            'invalid_mail'  => 'Mail must be valid values',

            'exists_id'     => 'id already exists',
            'not_exists_id' => 'id not exists',
            'not_modify_id' => 'id cannot be modify',          
            'not_a_number'    => 'Age must be valid values',
            'not_a_string'    => 'Description must be valid values',
            'not_found'     => 'No data found',
            '' => ''
        );

    const ERR_DAO =
        array(
            'insert' => 'Error inserting data',
            'update' => 'Error updating data',
            'delete' => 'Error deleting data',
            'used'   => 'No data deleted, Category in use',
            'not_exists_email' => 'Email not exists',
            'invalid_password' => 'Password is not correct',
            '' => ''
        );
    
}