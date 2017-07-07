<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace patpwilly\sapidoc\classes;
/**
 * Description of sap_idoc_input
 *
 * @author pwilliamson
 */
class SapIdocInput {
     use \patpwilly\sapidoc\traits\TraitsXml;
    protected $iDoc;
    /**
     * 
     * @param type $str -- xml string of the entire document
     */
    public function readInString($str){
        $this->iDoc = new \SimpleXMLElement($str);
        return true;
    }
    /**
     * 
     * @param type $file -- file path location of IDoc
     */
    public function readInFile($file){
        $str = file_get_contents($file);
        return $this->readInString($str);
    }
    
    
    public function getIDocType()
    {
        // currently from INVOIC02 we know this is true
        return $this->iDoc->IDOC->EDI_DC40->IDOCTYP;
    }
    public function getCreateDate()
    {
            return $this->iDoc->IDOC->EDI_DC40->CREDAT;
    }
    public function getCreateTime()
    {
            return $this->iDoc->IDOC->EDI_DC40->CRETIM;
    }	
    public function getSerialNum()
    {
            return $this->iDoc->IDOC->EDI_DC40->SERIAL;
    }

}
