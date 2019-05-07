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
    
    public function add($pub): bool {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return FALSE;
        };

        try {
            $sql = <<<SQL
            INSERT INTO Pubs (pub_id,doi,title,abstract,pub_type,link_web,link_download,json_retieval,json_crossref,json_article,json_scopus)
                 VALUES (NULL,:doi,:title,:abstract,:pub_type,:link_web,NULL,:json_retieval,:json_crossref,:json_article,:json_scopus);

SQL;
            $stmt = $this->connect->prepare($sql);

            $stmt->bindValue(":doi",            $pub->getDoi(),         PDO::PARAM_STR);
            $stmt->bindValue(":title",          $pub->getTitle(),       PDO::PARAM_STR);
            $stmt->bindValue(":abstract",       $pub->getAbstract(),    PDO::PARAM_STR);
            $stmt->bindValue(":pub_type",       $pub->getPubType(),     PDO::PARAM_STR);
            $stmt->bindValue(":link_web",       $pub->getLinkWeb(),     PDO::PARAM_STR);
            $stmt->bindValue(":json_retieval",  $pub->getJsonRetieval(),PDO::PARAM_STR);
            $stmt->bindValue(":json_crossref",  $pub->getJsonCossref(), PDO::PARAM_STR);
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
