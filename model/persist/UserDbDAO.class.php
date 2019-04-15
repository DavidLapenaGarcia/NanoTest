<?php
require_once "model/persist/ConnectDb.class.php";

class UserDbDAO  {
    
    private static $instance = NULL; 
    private $connect; 

    public function __construct() {
        $this->connect = (new ConnectDb())->getConnection();
    }


    public static function getInstance(): UserDbDAO {
        if (self::$instance == NULL) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function add($user): bool {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return FALSE;
        };

        try {
            $sql = <<<SQL
                INSERT INTO Users (name,password)
                    VALUES (:name,:password);
SQL;

            $stmt = $this->connect->prepare($sql);
            $stmt->bindValue(":name", $user->getName(), PDO::PARAM_STR);
            $stmt->bindValue(":password", $user->getPassword(), PDO::PARAM_STR);

            $stmt->execute();

            if ($stmt->rowCount()) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            return FALSE;
        }
        
    }

    public function listAll(): array {
        $result = array();

        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return $result;
        };

        try {
            $sql = <<<SQL
                SELECT name,password FROM Users;
SQL;

            $stmt = $this->connect->query($sql); 

            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return $result;
        }

        return $result;
    }

    public function modify($user): bool {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return FALSE;
        };

        try {
            $sql = <<<SQL
                UPDATE Users SET password=:password
                    WHERE name=:name;
SQL;

            $stmt = $this->connect->prepare($sql);
            $stmt->bindValue(":password", $user->getPassword(), PDO::PARAM_STR);
            $stmt->bindValue(":name", $user->getName(), PDO::PARAM_STR);

            $stmt->execute();
            
            if ($stmt->rowCount()) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            
            return FALSE;
        }
    }

    public function searchByName($username) {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return NULL;
        };

        try {
            $sql = <<<SQL
                SELECT username,password,age,role,active FROM user WHERE username=:username;
SQL;

            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);

            $stmt->execute();

            if ($stmt->rowCount()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
                return $stmt->fetch();
            } else {
                return NULL;
            }
        } catch (PDOException $e) {
            return NULL;
        }
    }

}
