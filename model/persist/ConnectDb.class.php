<?php
class ConnectDb {
    
    public function __consrtuct() {

    }

    public function getConnection() {
        $hostname='localhost';
        $username='admin';
        $password='admin';
        $dbname='nanoTest';

        $conn=NULL;

        try {
            $conn=new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8",$username,$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {

        }

        return $conn;

    }
}

