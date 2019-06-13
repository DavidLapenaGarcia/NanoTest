<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Access-Control-Allow-Headers: append,delete,entries,foreach,get,has,keys,set,values,Authorization');

    session_start();
    require_once "controller/ws/ServiceMainController.class.php";

    $controlService = new ServiceMainController();
    $controlService->processRequest();