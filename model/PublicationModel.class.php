<?php

require_once "model/persist/PublicationDAO.class.php";
require_once "model/persist/PublicationKeywordsDAO.class.php";
class PublicationModel {

    private $pubDAO;

    public function __construct() {
        $this->pubDAO=PublicationDAO::getInstance();
        $this->pubKeysDAO=PublicationKeywordsDAO::getInstance();          
    }


    public function listAll():array {
        $pubs = $this->pubDAO->listAll();
        return $pubs;
    }

    public function listUserPubs($userId = null):array {
        if ($userId == null) {
            $userId = unserialize($_SESSION['user'])->getId();
        }
        $pubs = $this->pubDAO->listUserPubs($userId);
        if(!is_null($pubs)){

            foreach($pubs as $pub) {
                if( $this->pubKeysDAO->isKeys($pub->getId(), $userId)) {
                    //var_dump('3aa');
                    $keys = $this->pubKeysDAO->getAllByPubId($pub->getId(), $userId);
                }else{
                    $keys = NULL;
                }
                $pub->setKeywords($keys);
            }  
        }
        return $pubs;
    }

    public function search($doi) {
        $result = $this->pubDAO->searchByDoi($doi);

        if( !is_null($result) ) {
            if($this->pubKeysDAO->isKeys($result->getId())) {
                $keys = $this->pubKeysDAO->getAllByPubId($result->getId());
            }else{
                $keys = NULL;
            }
            $result->setKeywords($keys);

        }else{
            $_SESSION['error']=PubMessage::ERR_DAO['not_found']; 
        }
        return $result;
    }

    public function searchId($id) {
        //var_dump($id);
        $result = $this->pubDAO->searchById($id);
        //var_dump($result);
        return $result;
    }
    
    public function add($pub):bool {
        $result = $this->pubDAO->add($pub);
        if ($result == FALSE && empty($_SESSION['error'])) {
            $_SESSION['error'] = PubMessage::ERR_DAO['insert'];
        }
        return $result;
    }
    
    public function update($pub):bool {
        $result=$this->pubDAO->update($pub);
        // var_dump($result);
        if ($result==FALSE) {
            $_SESSION['error']=PubMessage::ERR_DAO['update'];
        } 
        return $result;
    }
    public function delete($pubId):bool {
        $result=$this->pubDAO->delete($pubId);
        if ($result==FALSE) {
            $_SESSION['error']=PubMessage::ERR_DAO['delete'];
        } 
        return $result;
    }



    
    
}

