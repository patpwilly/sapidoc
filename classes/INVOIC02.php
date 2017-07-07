<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace prome\sap\classes;

/**
 * Description of INVOIC02
 *
 * @author pwilliamson
 */
class INVOIC02 extends SapIdocInput {
    // E1EDK01
    public function getInvoiceNum()
    {
        return $this->iDoc->IDOC->E1EDK01->BELNR;
    }
    public function getPartnerNum()
    {
        return $this->iDoc->IDOC->E1EDK01->RECIPNT_NO;
    }
    /*
     * May require modifications to use E1EDK14->QUALF['012']
     */
    public function getOrderType()
    {
        return $this->firstNodeAttribute("IDOC/E1EDK01/ZE1EDK01",'ZAUART', null);
    }

    // E1EDK02 Segments
    public function geSalesDocument()
    {
        return $this->iDoc->xpath("IDOC/E1EDK02/QUALF[.='002']/parent::*")[0]->BELNR;
    }    
    public function getSalesDate()
    {
        return $this->iDoc->xpath("IDOC/E1EDK02/QUALF[.='002']/parent::*")[0]->DATUM;
    }        
    public function getBillingDocument()
    {
        return $this->iDoc->xpath("IDOC/E1EDK02/QUALF[.='009']/parent::*")[0]->BELNR;
    }    
    public function getBillingDate()
    {
        return $this->iDoc->xpath("IDOC/E1EDK02/QUALF[.='009']/parent::*")[0]->DATUM;
    }
    // E1EDK14
    
    public function getSalesChannelCode()
    {
        return $this->firstNodeAttribute("IDOC/E1EDK14/QUALF[.='007']/parent::*", 'ORGID', null);
    }
    public function getSalesOrg()
    {
        return $this->firstNodeAttribute("IDOC/E1EDK14/QUALF[.='008']/parent::*", 'ORGID', null);
    }    
    public function getBillingType()
    {
        return $this->firstNodeAttribute("IDOC/E1EDK14/QUALF[.='015']/parent::*", 'ORGID', null);
    }
    public function getSalesOfficeCode()
    {
        //  We should have one element like this, if not we return the first
        return $this->firstNodeAttribute("IDOC/E1EDK14/QUALF[.='016']/parent::*", 'ORGID', null);
    }
    /**
     * This just calls getSalesOfficeCode for now, the example didn't enlighten 
     * if this code is duplicated or for one or the other
     * 
     * @return string
     */
    public function getSalesOrderOfficeCode()
    {
        return $this->getSalesOfficeCode();
    }
    
    // E1EDP01
    public function getItems()
    {
        $itemArray = [];
        foreach($this->iDoc->IDOC->E1EDP01 as $item)
        {
            $itemArray[] = new INVOIC02_E1EDP01($item);
        }
        return $itemArray;
    }
    
    // E1EDS01
    public function getNumberOfItems()
    {
        return $this->firstNodeAttribute("IDOC/E1EDS01/SUMID[.='001']/parent::*",'SUMME');
    }
    public function getSalesTaxTotal()
    {
        return $this->firstNodeAttribute("IDOC/E1EDS01/SUMID[.='005']/parent::*",'SUMME');
    }   
    public function getNetInvoiceValue()
    {
        return $this->firstNodeAttribute("IDOC/E1EDS01/SUMID[.='010']/parent::*",'SUMME');
    }         
    public function getBilledValue()
    {
        return $this->firstNodeAttribute("IDOC/E1EDS01/SUMID[.='011']/parent::*",'SUMME');
    }     
    public function getQualifyAmountForCashDiscount()
    {
        return $this->firstNodeAttribute("IDOC/E1EDS01/SUMID[.='012']/parent::*",'SUMME');
    }
}
