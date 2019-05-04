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

    public function byIdentifier($toSearch, $searchAs) {

        $rAbstractRetrieval = $this->elsevier->abstractRetrieval($toSearch, $searchAs);
        $rArticleRetrieval = $this->elsevier->articleRetrieval($toSearch);
        $rCrossref = $this->crossref->getData($toSearch, $searchAs);
        $rScopusSearch = $this->elsevier->scopusSearchByDoi($toSearch);

        if(!is_null($rAbstractRetrieval)){
            $pub = new Publication(0,
                $rAbstractRetrieval["abstracts-retrieval-response"]["coredata"]["prism:doi"], //doi
                $rAbstractRetrieval["abstracts-retrieval-response"]["coredata"]["dc:title"], //title
                $rArticleRetrieval["full-text-retrieval-response"]["coredata"]["dc:description"], // abstract   $rArticleRetrieval["full-text-retrieval-response"]["coredata"]["dc:description"]
                $rCrossref["author"] , // authors    $rCrossref["author"]  
                                            //  OR cretaor: $rAbstractRetrieval["abstracts-retrieval-response"]["coredata"]["dc:creator"]["author"]
                                            // NOTE:    $rCrossref["author"] returns arrayAuthors[initials, surname, squence[first,additional,?], affiliation[empty] ;
                                            //          Does not return some author id.
                $rScopusByDoi["search-results"]["entry"][0]["subtypeDescription"], // pubtype    $rScopusByDoi
                $rAbstractRetrieval["abstracts-retrieval-response"]["coredata"]["link"][1]["@href"], // linkWeb
                NULL, // linkDownload
                $rAbstractRetrieval, //ElsevierAPI-> rAbstractRetrieval
                $rCrossref, // CrossrefAPI-> jsonCossref
                $rArticleRetrieval, // ElsevierAPI-> $rArticleRetrieval["full-text-retrieval-response"]["coredata"]["dc:description"]
                $rScopusSearch        // ElsevierAPI->  $rScopusSearch
            );
            return  $pub;
            // return  $pub;
        }else {
            array_push($_SESSION['error'], "Fail on ElsevierAPI");
            return NULL;
        }

    }

    public function byAbstract($toSearch) {
        $result = $this->elsevier->scopusAbstract($toSearch);
        if(!is_null($result)){
            return  $result;
        }else {
            array_push($_SESSION['error'], "Fail on ElsevierAPI");
            return NULL;
        }
    }
    
    function returnVirtualScopusSearch(){
        $str = file_get_contents('../api/Notes-Elsevier/returns/Scopus_Search/https%3A%2F%2Fapi.elsevier.com%2Fcontent%2Fsearch%2Fscopus?query=all(gene)&apiKey=7f59af901d2d86f78a1fd60c1bf9426a.json');
        $json = json_decode($str, true);
        return json_decode();
    }
}
