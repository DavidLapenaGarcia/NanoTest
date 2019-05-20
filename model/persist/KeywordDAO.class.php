<?php
require_once "model/persist/ConnectDb.class.php";

class KeywordDAO  {
    
    private static $instance = NULL; 
    private $connect; 

    public function __construct() {
        $this->connect = (new ConnectDb())->getConnection();
    }
    
    public static function getInstance(): KeywordDAO {
        if (self::$instance == NULL) {
            self::$instance = new self();
        }
        return self::$instance;
    }
  
    


    public function listAll(): array {
        $result = array();
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return $result;
        };
        try {
            $sql = <<<SQL
                SELECT keyWordId,totem,contented FROM Key_words;
SQL;
            $stmt = $this->connect->query($sql); 

            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Keyword');

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return $result;
        }
        return $result;
    }

    public function searchById($keyWordId) {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return NULL;
        };
        try {
            $sql = <<<SQL
                SELECT keyWordId,totem,contented
                FROM Key_words WHERE keyWordId=:keyWordId;
SQL;

            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(":keyWordId", $keyWordId, PDO::PARAM_STR);

            $stmt->execute();

            if ($stmt->rowCount()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Keyword');
                return $stmt->fetch();
            } else {
                return NULL;
            }
        } catch (PDOException $e) {
            return NULL;
        }
    }
  
    public function add($keyw): bool {
        var_dump('<br/>keyw');
        var_dump($keyw);
        var_dump('<br/>');
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return FALSE;
        };
        try {
            $sql = <<<SQL
            INSERT  INTO Key_words   (keyWordId, totem, contented)
                    VALUES      (NULL, :totem, :contented);

SQL;
            $stmt = $this->connect->prepare($sql);

            $stmt->bindValue(":totem",      $keyw->getTotem(),   PDO::PARAM_STR);
            $stmt->bindValue(":contented",  $keyw->getContented(),  PDO::PARAM_STR);

        $stmt->execute();

            if ($stmt->rowCount()) {
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            var_dump($e);
            return FALSE;
        }
        
    }

    public function modify($keyw): bool {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return FALSE;
        };
        try {
            $sql = <<<SQL
                UPDATE Key_words SET totem=:totem, contented=:contented 
                            WHERE keyWordId=:keyWordId;
SQL;

            $stmt = $this->connect->prepare($sql);

            $stmt->bindValue(":keyWordId",  $keyw->getId(),         PDO::PARAM_STR);
            $stmt->bindValue(":totem",      $keyw->getTotem(),      PDO::PARAM_STR);
            $stmt->bindValue(":contented",  $keyw->getContented(),  PDO::PARAM_STR);

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

    public function delete($keyWordId): bool {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return FALSE;
        };
        try {
            $sql = <<<SQL
                    DELETE FROM Key_words WHERE keyWordId=:keyWordId;
SQL;
var_dump($sql);
            $stmt = $this->connect->prepare($sql);
            $stmt->bindValue(":keyWordId", $keyWordId, PDO::PARAM_INT);

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

    public function update($keyw): bool {
        var_dump($keyw);
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return FALSE;
        };
        try {
            $sql = <<<SQL
                UPDATE Key_words    SET totem=:totem, contented=:contented
                                    WHERE keyWordId=:keyWordId;
SQL;
//var_dump($sql);
            $stmt = $this->connect->prepare($sql);

            $stmt->bindValue(":keyWordId", $keyw->getId(),          PDO::PARAM_INT);
            $stmt->bindValue(":totem",      $keyw->getTotem(),       PDO::PARAM_STR);
            $stmt->bindValue(":contented",  $keyw->getContented(),   PDO::PARAM_STR);


            return $stmt->execute();
        } catch (Exception $ex) {
            var_dump($ex);
            return FALSE;
        }
    }



}

