<?php
require_once "ElsevierAPI/ElsevierApi.class.php";
require_once "model/Publication.class.php";
require_once "CrossrefAPI/CrossrefApi.class.php";

class DownloadApi {

    private $elsevier;
    private $crossref;
    public $pub;

    public function __construct() {
        $this->elsevier = new ElsevierApi();
        $this->crossref = new CrossrefApi();
        $this->pub = new Publication();
    }

    // byIdentifier

    public function byIdentifier($toSearch, $searchAs=NULL) {
        if(is_null($searchAs)){
            $searchAs = "doi"; 
        }
        $rAbstractRetrieval = $this->elsevier->abstractRetrieval($toSearch, $searchAs);
        $rArticleRetrieval = $this->elsevier->articleRetrieval($toSearch);
        $rCrossref = $this->crossref->getData($toSearch, $searchAs);
        $rScopusSearch = $this->elsevier->scopusSearchByDoi($toSearch);

        $pub = $this->makePublication($rAbstractRetrieval,$rArticleRetrieval, $rCrossref, $rScopusSearch);

        if( !is_null($pub) ) {
            return $pub;
        } else {
            array_push($_SESSION['error'], "Fail on DownloadAPI / byIdentifier");
            return NULL;
        }
    }


    public function byAbstract($toSearch) {
        $scopusAbstract = $this->elsevier->scopusAbstract($toSearch);

        if(!is_null($scopusAbstract)){
            $doi = $scopusAbstract["search-results"]["entry"][0]["prism:doi"];
            // TODO Validate doi
            $pub = $this->byIdentifier($doi);
            return  $pub;
        }else {
            array_push($_SESSION['error'], "Fail on DownloadAPI / byAbstract");
            return NULL;
        }
    }
    public function byAuthor($auid=NULL, $name=NULL, $surname=NULL, $afid=NULL, $city=NULL, $country=NULL) {
        $scopusAbstract = $this->elsevier->scopusAuthor($auid, $name, $surname, $afid, $city, $country);
        if(!is_null($scopusAbstract)){
            /**
            * toSearch example:
            * doi = $scopusAbstract["search-results"]["entry"][0]["prism:doi"];
            * TODO Validate doi
            * $pub = $this->byIdentifier($doi);
            **/
            
            return  $scopusAbstract;
        }else {
            array_push($_SESSION['error'], "Fail on DownloadAPI / scopusAuthor");
            return NULL;
        }
    }
    
    
    private function makePublication($rAbstractRetrieval,$rArticleRetrieval, $rCrossref, $rScopusSearch) {

        $pub = new Publication();

        if (!is_null($rAbstractRetrieval)){  
            $pub->setDoi($rAbstractRetrieval["abstracts-retrieval-response"]["coredata"]["prism:doi"]);
            $pub->setTitle($rAbstractRetrieval["abstracts-retrieval-response"]["coredata"]["dc:title"]);
            $pub->setLinkWeb($rAbstractRetrieval["abstracts-retrieval-response"]["coredata"]["link"][1]["@href"]);
            $pub->setJsonRetieval($rAbstractRetrieval);
        } else {
            array_push($_SESSION['error'], "Fail on DownloadAPI / makePublication / rAbstractRetrieval /");            
        } 
        
        if (!is_null($rScopusSearch)){  
            $pub->setPubType($rScopusSearch["search-results"]["entry"][0]["subtypeDescription"]);
            $pub->setJsonScopus($rScopusSearch);
        } else {
            array_push($_SESSION['error'], "Fail on DownloadAPI / makePublication / ScopusSearch /");            
        } 

        if (!is_null($rArticleRetrieval)){ 
            $pub->setAbstract($rArticleRetrieval["full-text-retrieval-response"]["coredata"]["dc:description"]);
            $pub->setJsonArticle($rArticleRetrieval);
        } else {
            array_push($_SESSION['error'], "Fail on DownloadAPI / makePublication / rArticleRetrieval /");           
        }

        if (!is_null($rCrossref)){  
            $pub->setAuthors($rCrossref["author"]);
            $pub->setJsonCossref($rCrossref);
        } else {
            array_push($_SESSION['error'], "Fail on DownloadAPI / rCrossref /");
        }

        return  $pub;
    }
}
