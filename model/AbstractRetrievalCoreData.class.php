<?php
require_once "model/AbstractRetrievalCoreDataLink.class.php";
require_once "model/AbstractRetrievalCoreDataAuthor.class.php";

class AbstractRetrievalCoreData {
    
    private $srctype;
    private $eid;
    private $pubmedId;
    private $coverDate;
    private $aggregationType;
    private $url;
    private $creator;
    private $link;
    private $sourceId;
    private $pii;
    private $citedbyCount;
    private $volume;
    private $subtype;
    private $title;
    private $openaccess;
    private $issn;
    private $issueIdentifier;
    private $subtypeDescription;
    private $publicationName;
    private $pageRange;
    private $endingPage;
    private $openaccessFlag;
    private $doi;
    private $startingPage;
    private $identifie;

    public function __construct($srctype=NULL, $eid=NULL, $pubmedId =NULL,
                                $coverDate=NULL,$aggregationType=NULL, $url=NULL,
                                $creator=NULL,$link=NULL,$sourceId=NULL, 
                                $pii=NULL,$citedbyCount=NULL,$volume=NULL,
                                $subtype=NULL, $title=NULL,$openaccess=NULL,
                                $issn=NULL, $issueIdentifier=NULL, $subtypeDescription=NULL,
                                $publicationName=NULL,$pageRange=NULL,$endingPage=NULL,
                                $openaccessFlag=NULL, $doi=NULL,$startingPage=NULL,
                                $identifier=NULL
                                ) {
        $this->srctype  = $srctype;
        $this->eid  = $eid;
        $this->pubmedId  = $pubmedId;
        $this->coverDate  = $coverDate;
        $this->aggregationType  = $aggregationType;
        $this->url  = $url;
        $this->creator  = $creator;
        $this->link  = $link;
        $this->sourceId  = $sourceId;
        $this->pii  = $pii;
        $this->citedbyCount  = $citedbyCount;
        $this->volume  = $volume;
        $this->subtype  = $subtype;
        $this->title  = $title;
        $this->openaccess  = $openaccess;
        $this->issn  = $issn;
        $this->issueIdentifier  = $issueIdentifier;
        $this->subtypeDescription  = $subtypeDescription;
        $this->publicationName  = $publicationName;
        $this->pageRange  = $pageRange;
        $this->endingPage  = $endingPage;
        $this->openaccessFlag  = $openaccessFlag;
        $this->doi  = $doi;
        $this->startingPage  = $startingPage;
        $this->identifie  = $identifie;
        $this->doi=$doi;
        $this->city=$city;
        $this->name=$name;
        $this->country=$country;
    }

    public function getDoi(): string {
        return $this->doi;
    }
    public function setDoi($doi): string {
        $this->doi=$doi;
    }

    public function getSrctype() {
        return $this->srctype;
    }
    public function setCity($srctype) {
        $this->srctype=$srctype;
    }

    public function getEid() {
        return $this->eid;
    }
    public function setEid($eid) {
        $this->eid=$eid;
    }

    public function getPubmedId() {
        return $this->pubmedId;
    }
    public function setPubmedId($pubmedId) {
        $this->pubmedId=$pubmedId;
    }

    public function getCoverDate() {
        return $this->coverDate;
    }
    public function setCoverDate($coverDate) {
        $this->coverDate=$coverDate;
    }

    public function getAggregationType() {
        return $this->aggregationType;
    }
    public function setaggregationType($aggregationType) {
        $this->aggregationType=$aggregationType;
    }

    public function getUrl() {
        return $this->eid;
    }
    public function setUrl($url) {
        $this->url=$url;
    }

    public function getCreator(): AbstractRetrievalCoreDataAuthor {
        return $this->creator;
    }
    public function setCreator($creator) {
        $this->creator=$creator;
    }

    public function getLink(): AbstractRetrievalCoreDataLink {
        return $this->link;
    }
    public function setLink($link) {
        $this->link=$link;
    }

    public function getSourceId() {
        return $this->sourceId;
    }
    public function setSourceId($sourceId) {
        $this->sourceId=$sourceId;
    }

    public function getPii() {
        return $this->pii;
    }
    public function setPii($pii) {
        $this->pii=$pii;
    }

    public function getCitedByCount() {
        return $this->citedbyCount;
    }
    public function setCitedByCount($citedbyCount) {
        $this->citedbyCount=$citedbyCount;
    }

    public function getVolume() {
        return $this->volume;
    }
    public function setVolume($volume) {
        $this->volume=$volume;
    }

    public function getSubtype() {
        return $this->subtype;
    }
    public function setSubtype($subtype) {
        $this->subtype=$subtype;
    }

    public function getTitle() {
        return $this->title;
    }
    public function setTitle($title) {
        $this->title=$title;
    }

    public function getOpenaccess() {
        return $this->openaccess;
    }
    public function setOpenaccess($openaccess) {
        $this->openaccess=$openaccess;
    }

    public function getISSN() {
        return $this->issn;
    }
    public function setISSN($issn) {
        $this->issn=$issn;
    }

    public function getIssueIdentifier() {
        return $this->issueIdentifier;
    }
    public function setIssueIdentifier($issueIdentifier) {
        $this->issueIdentifier=$issueIdentifier;
    }

    public function getSubtypeDescription() {
        return $this->subtypeDescription;
    }
    public function setSubtypeDescription($subtypeDescription) {
        $this->subtypeDescription=$subtypeDescription;
    }

    public function getPublicationName() {
        return $this->publicationName;
    }
    public function setPublicationName($publicationName) {
        $this->publicationName=$publicationName;
    }

    public function getPageRange() {
        return $this->pageRange;
    }
    public function setPageRange($pageRange) {
        $this->pageRange=$pageRange;
    }

    public function getEndingPage() {
        return $this->endingPage;
    }
    public function setEndingPage($endingPage) {
        $this->endingPage=$endingPage;
    }

    public function getOpenaccessFlag() {
        return $this->openaccessFlag;
    }
    public function setOpenaccessFlag($openaccessFlag) {
        $this->openaccessFlag=$openaccessFlag;
    }

    public function getStartingPage() {
        return $this->startingPage;
    }
    public function setStartingPage($startingPage) {
        $this->startingPage=$startingPage;
    }

    public function getIdentifie() {
        return $this->identifie;
    }
    public function setIdentifie($identifie) {
        $this->identifie=$identifie;
    }

    public function __toString() {
        return sprintf("%s;%s;%s;%s;%s;%s;%s;%s;%s;%s;%s;%s;%s;%s;%s;%s;%s;%s;%s;%s;%s;%s;%s;\n", 
            $this->$srctype,
            $this->$eid,
            $this->$pubmedId,
            $this->$coverDate,
            $this->$aggregationType,
            $this->$url,
            $this->$creator,
            $this->$link,
            $this->$sourceId,
            $this->$pii,
            $this->$citedbyCount,
            $this->$volume,
            $this->$subtype,
            $this->$title,
            $this->$openaccess,
            $this->$issn,
            $this->$issueIdentifier,
            $this->$subtypeDescription,
            $this->$publicationName,
            $this->$pageRange,
            $this->$endingPage,
            $this->$openaccessFlag,
            $this->$doi,
            $this->$startingPage,
            $this->$identifie
            );
    }
    
}
