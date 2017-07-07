<?php
namespace patpwilly\sapidoc\traits;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
trait TraitsXml {
    public function firstNodeAttribute($path, $attribute, $default=0)
    {
        $nodes = $this->iDoc->xpath($path);
        if(count($nodes)==0 || !isset($nodes[0]->$attribute))
            return $default;
        
        return $nodes[0]->$attribute;        
    }
    /**
     * 
     * @param type $xpath
     * @param type $default
     * @returns xml node or $default value if not found
     */
    public function firstNode($path, $default=false)
    {
        // Or possibly <QUALF>013</QUALF>
        $nodes = $this->iDoc->xpath($path);
        if(count($nodes)==0)
            return $default;
        
        return $nodes[0];
    }
}