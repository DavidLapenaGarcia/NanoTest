<?php

class DownloadMessage {

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
            'empty_data'      => 'Data must be filled',
            'empty_choose'    => 'Choose must be filled',
            'invalid_data'    => 'Input data must be valid',
            'invalid_name'  => 'name must be valid values',
        );

    const ERR_DAO =
        array(
            'insert' => 'Error inserting data',
            'update' => 'Error updating data',
            'delete' => 'Error deleting data',
            '' => ''
        );
    
}