<?php
require_once "model/persist/ConnectDb.class.php";

class PublicationDAO  {
    
    private static $instance = NULL; 
    private $connect; 

    public function __construct() {
        $this->connect = (new ConnectDb())->getConnection();
    }
    
    public static function getInstance(): PublicationDAO {
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
                SELECT pubId,doi,title,abstract,pubType,linkWeb,linkDownload,jsonRetieval,jsonCrossref,jsonArticle,jsonScopus FROM Pubs;
SQL;

            $stmt = $this->connect->query($sql); 

            $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Publication');

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return $result;
        }
        return $result;
    }

    public function listUserPubs($userId = NULL): array {
        $result = array();
        
        if ($userId == null) {
            $userId = unserialize($_SESSION['user'])->getId();
        }

        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return $result;
        };

        try {
            $sql = <<<SQL
            SELECT DISTINCT Pubs . pubId , Pubs . doi, Pubs . title, Pubs . abstract, 
                            Pubs . pubType, Pubs . linkWeb, Pubs . linkDownload,
                            Pubs . jsonRetieval, Pubs . jsonCrossref, Pubs . jsonArticle, Pubs . jsonScopus
            FROM Pubs JOIN pubs_keywords 
            ON Pubs . pubId IN ( 
                SELECT pubId 
                FROM pubs_keywords 
                WHERE pubs_keywords.userId = :userId
                ) 
            ORDER BY Pubs.pubId ASC;
SQL;
            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(":userId", $userId,    PDO::PARAM_STR);    
            $stmt->execute();

            if ($stmt->rowCount()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Publication');
                return $stmt->fetchAll();
            }

        } catch (PDOException $e) {
        }
        return $result;
    }


    public function searchByDoi($doi) {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return NULL;
        };
        try {
            $sql = <<<SQL
                SELECT pubId,doi,title,abstract,pubType,linkWeb,linkDownload,jsonRetieval,jsonCrossref,jsonArticle,jsonScopus
                FROM Pubs WHERE doi=:doi;
SQL;

            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(":doi", $doi, PDO::PARAM_STR);

            $stmt->execute();

            if ($stmt->rowCount()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Publication');
                return $stmt->fetch();
            } else {
                return NULL;
            }
        } catch (PDOException $e) {
            return NULL;
        }
    }

    public function searchById($pubId) {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return NULL;
        };
        try {
            $sql = <<<SQL
                SELECT pubId,doi,title,abstract,pubType,linkWeb,linkDownload,jsonRetieval,jsonCrossref,jsonArticle,jsonScopus
                FROM Pubs WHERE pubId=:pubId;
SQL;

            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(":pubId", $pubId, PDO::PARAM_STR);

            $stmt->execute();

            if ($stmt->rowCount()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Publication');
                return $stmt->fetch();
            } else {
                return NULL;
            }
        } catch (PDOException $e) {
        //var_dump($e);
            return NULL;
        }
    }

    
    public function add($pub): bool {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return FALSE;
        };
        try {
            $sql = <<<SQL
            INSERT INTO Pubs ( pubId, doi, title, abstract, pubType, linkWeb, linkDownload, jsonRetieval, jsonCrossref, jsonArticle, jsonScopus)
                 VALUES (NULL, :doi, :title, :abstract, :pub_type, :link_web, NULL, :json_retieval, :json_crossref, :json_article,  :json_scopus);

SQL;
            $stmt = $this->connect->prepare($sql);

            $stmt->bindValue(":doi",            $pub->getDoi(),         PDO::PARAM_STR);
            $stmt->bindValue(":title",          $pub->getTitle(),       PDO::PARAM_STR);
            $stmt->bindValue(":abstract",       $pub->getAbstract(),    PDO::PARAM_STR);
            $stmt->bindValue(":pub_type",       $pub->getPubType(),     PDO::PARAM_STR);
            $stmt->bindValue(":link_web",       $pub->getLinkWeb(),     PDO::PARAM_STR);
            $stmt->bindValue(":json_retieval",  $pub->getJsonRetieval(),PDO::PARAM_STR);
            $stmt->bindValue(":json_crossref",  $pub->getJsonCrossref(), PDO::PARAM_STR);
            $stmt->bindValue(":json_article",   $pub->getJsonArticle(), PDO::PARAM_STR);
            $stmt->bindValue(":json_scopus",    $pub->getJsonScopus(),  PDO::PARAM_STR);

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
        
    }

    public function modify($pub): bool {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return FALSE;
        };
        try {
            $sql = <<<SQL
                UPDATE Pubs SET doi=:doi,                   title=:title,               abstract=:abstract,
                                pubType=:pubType            linkWeb=:linkWeb            jsonRetieval:=jsonRetieval
                                jsonCrossref=:jsonCrossref  jsonArticle=:jsonArticle    jsonScopus=:jsonScopus  
                    WHERE doi=:wDoi;
SQL;

            $stmt = $this->connect->prepare($sql);

            $stmt->bindValue(":wDoi",           $pub->getDoi(),             PDO::PARAM_STR);

            $stmt->bindValue(":doi",            $pub->getDoi(),         PDO::PARAM_STR);
            $stmt->bindValue(":title",          $pub->getTitle(),       PDO::PARAM_STR);
            $stmt->bindValue(":abstract",       $pub->getAbstract(),    PDO::PARAM_STR);
            $stmt->bindValue(":pub_type",       $pub->getPubType(),     PDO::PARAM_STR);
            $stmt->bindValue(":link_web",       $pub->getLinkWeb(),     PDO::PARAM_STR);
            $stmt->bindValue(":json_retieval",  $pub->getJsonRetieval(),PDO::PARAM_STR);
            $stmt->bindValue(":json_crossref",  $pub->getJsonCrossref(), PDO::PARAM_STR);
            $stmt->bindValue(":json_article",   $pub->getJsonArticle(), PDO::PARAM_STR);
            $stmt->bindValue(":json_scopus",    $pub->getJsonScopus(),  PDO::PARAM_STR);
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

    public function delete($pubId): bool {
        //var_dump($pubId);
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return FALSE;
        };
        try {
            $sql = <<<SQL
                    DELETE FROM Pubs WHERE pubId=:pubId;
SQL;
            $stmt = $this->connect->prepare($sql);
            $stmt->bindValue(":pubId", $pubId, PDO::PARAM_INT);

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

    public function update($pub): bool {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return FALSE;
        };
        try {
            $sql = <<<SQL
                UPDATE Pubs SET doi=:doi,                     title=:title,                 abstract=:abstract,
                                pubType=:pubType,             linkWeb=:linkWeb,             linkDownload=:linkDownload,
                                jsonRetieval=:jsonRetieval,   jsonCrossref=:jsonCrossref,   jsonArticle=:jsonArticle,
                                jsonScopus=:jsonScopus
                            WHERE pubId=:pubId;
SQL;
//var_dump($sql);
            $stmt = $this->connect->prepare($sql);
            $stmt->bindValue(":pubId",          $pub->getId(),              PDO::PARAM_INT);
            $stmt->bindValue(":doi",            $pub->getDoi(),             PDO::PARAM_STR);
            $stmt->bindValue(":title",          $pub->getTitle(),           PDO::PARAM_STR);
            $stmt->bindValue(":abstract",       $pub->getAbstract(),        PDO::PARAM_STR);
            $stmt->bindValue(":pubType",        $pub->getPubType(),         PDO::PARAM_STR);
            $stmt->bindValue(":linkWeb",        $pub->getLinkWeb(),         PDO::PARAM_STR);
            $stmt->bindValue(":linkDownload",   NULL,                       PDO::PARAM_STR);
            $stmt->bindValue(":jsonRetieval",   $pub->getJsonRetieval(),    PDO::PARAM_STR);
            $stmt->bindValue(":jsonCrossref",   $pub->getJsonCrossref(),    PDO::PARAM_STR);
            $stmt->bindValue(":jsonArticle",    $pub->getJsonArticle(),     PDO::PARAM_STR);
            $stmt->bindValue(":jsonScopus",     $pub->getJsonScopus(),      PDO::PARAM_STR);

            $stmt->execute(); // devuelve TRUE o FALSE
            return $stmt->execute();
        } catch (Exception $ex) {
            // var_dump($ex);
        }
            return FALSE;
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

