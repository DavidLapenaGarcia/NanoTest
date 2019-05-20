<?php

class KeyMessage {

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
            'empty_totem'    => 'Totem must be filled',
            'empty_contented'    => 'Contented must be filled',

            'invalid_id'    => 'Id must be valid values',
            'invalid_totem'  => 'Totem must be valid values',
            'invalid_contented'  => 'Contented must be valid values',

            'exists_id'     => 'Id already exists',
            'not_exists_id' => 'Id not exists',
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
