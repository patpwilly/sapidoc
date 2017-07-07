<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace prome\sap\classes;

/**
 * Description of INVOIC02_Item
 * SimpleXMLElement pull from INVOIC02 class.
 * Each item is passed the SimpleXMLElement found
 * at IDOC->E1EDP01 as an individual object to take
 * advantage of get functions
 *
 * @author pwilliamson
 */
class INVOIC02_E1EDP01 {
    use \prome\sap\traits\TraitsXml;
    public $iDoc;
    public function __construct(\SimpleXMLElement $x)
    {
        $this->iDoc = $x;
    }
    // Root node for E1EDP01
    public function getQuantity()
    {
        return isset($this->iDoc->MENGE)?$this->iDoc->MENGE:0;
    }
    public function getBillingUnit()
    {
        return $this->iDoc->MENEE;
    }
    public function getSPONumber()
    {
        return $this->firstNodeAttribute("ZE1EDP01",'UPMAT', null);
    }
    // E1EDP02
    public function getSupplierOrderLineNum()
    {
        return $this->iDoc->xpath("E1EDP02/QUALF[.='002']/parent::*")[0]->ZEILE;
    }
    // E1EDP03
    public function getSupplierDeliveryDate()
    {
        return $this->iDoc->xpath("E1EDP03/QUALF[.='001']/parent::*")[0]->DATUM;
    }    
    public function getIDOCCreatedDate()
    {
        return $this->iDoc->xpath("E1EDP03/QUALF[.='011']/parent::*")[0]->DATUM;
    }    
    public function getPricingDate()
    {
        return $this->iDoc->xpath("E1EDP03/QUALF[.='023']/parent::*")[0]->DATUM;
    }
    public function getCreatedOnDate()
    {
        return $this->iDoc->xpath("E1EDP03/QUALF[.='025']/parent::*")[0]->DATUM;
    }    
    public function getServiceRenderedDate()
    {
        return $this->iDoc->xpath("E1EDP03/QUALF[.='027']/parent::*")[0]->DATUM;
    }
    public function getSalesOrderDate()
    {
        return $this->iDoc->xpath("E1EDP03/QUALF[.='029']/parent::*")[0]->DATUM;
    }
    // E1EDP19
    public function getVendorIdentifier()
    {
        //  We should have one element like this, if not we return the first
        return $this->iDoc->xpath("E1EDP19/QUALF[.='002']/parent::*")[0]->IDTNR;
    }
    public function getVendorDescription()
    {
        //  We should have one element like this, if not we return the first
        return $this->iDoc->xpath("E1EDP19/QUALF[.='002']/parent::*")[0]->KTEXT;        
    }
    public function getBatchNumber()
    {
        //  We should have one element like this, if not we return the first
        return $this->iDoc->xpath("E1EDP19/QUALF[.='010']/parent::*")[0]->IDTNR;        
    }  
   
    /**
     * Needs validated, but the difference between Invoice Total - Net Total for line item
     * @return type
     */
    // E1EDP26 Section
    public function getGrossPrice()
    {
        return $this->firstNodeAttribute("E1EDP26/QUALF[.='001']/parent::*",'BETRG');  
    }
    public function getGrossValue()
    {
        return $this->firstNodeAttribute("E1EDP26/QUALF[.='002']/parent::*",'BETRG');  
    }    
    public function getNetValue()
    {
        return $this->firstNodeAttribute("E1EDP26/QUALF[.='003']/parent::*",'BETRG');
    }   
    public function getQuailifyingAmountForCashDiscount()
    {
        return $this->firstNodeAttribute("E1EDP26/QUALF[.='004']/parent::*",'BETRG');
    }       
    public function getAbsoluteNetValue()
    {
        return $this->firstNodeAttribute("E1EDP26/QUALF[.='005']/parent::*",'BETRG');
    }
    /*
     * Net price per unit??
     */
    public function getNetPrice()
    {
        return $this->firstNodeAttribute("E1EDP26/QUALF[.='006']/parent::*",'BETRG');
    }
    public function getCashDiscountAmount()
    {
        return $this->firstNodeAttribute("E1EDP26/QUALF[.='007']/parent::*",'BETRG');
    }
    public function getGrossTotal()
    {
        return $this->firstNodeAttribute("E1EDP26/QUALF[.='010']/parent::*",'BETRG');        
    }    
    public function getAccruedBonus()
    {
        return $this->firstNodeAttribute("E1EDP26/QUALF[.='012']/parent::*",'BETRG');
    }  
    
    // custom derived information
    public function getNetTotal()
    {
        return ($this->getNetValue())-$this->getAccruedBonus();
    }
    
}
