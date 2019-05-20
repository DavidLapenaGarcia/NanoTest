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
                INSERT INTO Users (userId, name,password, mail)
                    VALUES (NULL, :name,:password, :mail);
SQL;

            $stmt = $this->connect->prepare($sql);
            $stmt->bindValue(":name", $user->getName(), PDO::PARAM_STR);
            $stmt->bindValue(":password", $user->getPassword(), PDO::PARAM_STR);
            $stmt->bindValue(":mail", $user->getMail(), PDO::PARAM_STR);

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
                SELECT userId,name,password,mail FROM Users;
SQL;

            $stmt = $this->connect->query($sql); 

            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return $result;
        }

        return $result;
    }

    public function delete($userId): bool {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return FALSE;
        };
        try {
            $sql = <<<SQL
                    DELETE FROM Users WHERE userId=:userId;
SQL;
            $stmt = $this->connect->prepare($sql);
            $stmt->bindValue(":userId", $userId, PDO::PARAM_INT);

            $stmt->execute(); // devuelve TRUE o FALSE
            if ($stmt->rowCount()) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (Exception $ex) {
            return FALSE;
        }
    }

    public function update($user): bool {
        var_dump($user);
        var_dump("<br/>");
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return FALSE;
        };
        try {
            $sql = <<<SQL
                UPDATE Users SET name=:name,   password=:password,  mail=:mail
                            WHERE userId=:userId;
SQL;
var_dump($sql);
            $stmt = $this->connect->prepare($sql);
            $stmt->bindValue(":userId",     $user->getId(),         PDO::PARAM_INT);
            $stmt->bindValue(":name",       $user->getName(),       PDO::PARAM_STR);
            $stmt->bindValue(":password",   $user->getPassword(),   PDO::PARAM_STR);
            $stmt->bindValue(":mail",       $user->getMail(),       PDO::PARAM_STR);

            $stmt->execute(); // devuelve TRUE o FALSE
            /* if ($stmt->rowCount()) {
                return TRUE;
            } else {
                return FALSE;
            } */
            return $stmt->execute();
        } catch (Exception $ex) {
            var_dump($ex);
            return FALSE;
        }
    }

    public function searchById($userId) {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return NULL;
        };

        try {
            $sql = <<<SQL
                SELECT userId, name, password, mail FROM Users WHERE userId=:userId;
SQL;

            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(":userId", $userId, PDO::PARAM_STR);

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

    public function searchName($name) {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return NULL;
        };

        try {
            $sql = <<<SQL
                SELECT * FROM Users 
                WHERE name=:name;
SQL;

            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);

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

    public function searchValid($name, $password) {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return NULL;
        };

        try {
            $sql = <<<SQL
                SELECT userId, name, password, mail FROM Users 
                WHERE name=:name AND password=:password;
SQL;

            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(":name",       $name, PDO::PARAM_STR);
            $stmt->bindParam(":password",   $password, PDO::PARAM_STR);

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
