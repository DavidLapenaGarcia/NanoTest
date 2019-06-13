<?php
require_once "model/persist/ConnectDb.class.php";

class PublicationKeywordsDAO  {
    
    private static $instance = NULL; 
    private $connect; 

    public function __construct() {
        $this->connect = (new ConnectDb())->getConnection();
    }
    
    public static function getInstance(): PublicationKeywordsDAO {
        if (self::$instance == NULL) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function isKeys($pubId, $userId=NULL): bool {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return $result;
        }

        if(!is_null($userId)) {
            $userId = unserialize($_SESSION['user'])->getId(); 
        }

        if(!is_string($pubId)){
            $pubId = strval($pubId);
        }
        try {
            $sql = <<<SQL
               SELECT * FROM pubs_keywords WHERE pubId =:pubId AND userId = :userId;
SQL;
            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(":pubId",  $pubId ,    PDO::PARAM_STR);
            $stmt->bindParam(":userId", $userId ,   PDO::PARAM_STR); //FIXME: must be a better wey 
            $stmt->execute();

            if ($stmt->rowCount()) {
                return TRUE;
            } else {
                return FALSE;
            }

        } catch (PDOException $e) {
            //var_dump($e);
            return FALSE;
        }
        return FALSE;
    }


    public function getAllByPubId($pubId, $userId=NULL) {
        $result = array();
        if(!is_null($userId)) {
           $userId = unserialize($_SESSION['user'])->getId(); 
        }
        
        //var_dump($pubId);
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return $result;
        }

        try {
            $sql = <<<SQL
                SELECT DISTINCT Key_words . keyWordId, Key_words . totem, Key_words . contented
                FROM Key_words JOIN pubs_keywords 
                ON Key_words . keyWordId IN ( 
                    SELECT keyWordId 
                    FROM pubs_keywords 
                    WHERE pubs_keywords.pubId = :pubId AND pubs_keywords.userId = :userId
                    ) 
                ORDER BY Key_words.keyWordId ASC;
SQL;
            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(":pubId",  $pubId,     PDO::PARAM_STR);
            $stmt->bindParam(":userId", $userId,    PDO::PARAM_STR);  //FIXME: must be a better wey      
            $stmt->execute();

            if ($stmt->rowCount()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Keyword');
                return $stmt->fetchAll();
            }

        } catch (PDOException $e) {
            //mp($e);
        }
        return $result;
    }


   /*  SELECT DISTINCT K.keyWordId, K.totem, K.contented
    FROM Key_words K JOIN pubs_keywords P 
    ON K.keyWordId IN ( 
        SELECT keyWordId 
        FROM pubs_keywords 
        WHERE pubs_keywords.pubId = 9 AND pubs_keywords.userId = 2) 
    ORDER BY `K`.`keyWordId` ASC
     */

}

