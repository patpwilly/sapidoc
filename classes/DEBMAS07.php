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
class DEBMAS07 extends SapIdocInput {
    use \prome\sap\traits\TraitsXml;
    public function getCustomerNumber()
    {
        // customer_number in SAP
        return $this->iDoc->IDOC->E1KNA1M->KUNNR;
    }
    public function getCustomerName()
    {
        // customer name in SAP
        return $this->iDoc->IDOC->E1KNA1M->NAME1;
    }
    /*
     * Defined MSGFN are:
     *  003 for deletion of object
     *  004 for changes of object
     *  005 for replace previous message
     *  009 for Original Message to process
     */
    public function getMsgFunction()
    {
        return $this->iDoc->IDOC->E1KNA1M->MSGFN;
    }
    /**
     * There may be more than 1 Master Sales data if it is part of multiple
     * organizations.
     * 
     * @return SimpleXML Node
     */
    public function getCustomerMasterSalesDataForOrg($org_code)
    {
        return $this->firstNode("IDOC/E1KNA1M/E1KNVVM/MSGFN[.='".$this->getMsgFunction()."' and ../VKORG='".$org_code."']/parent::*");
    }
    public function getCustomerMasterSalesData()
    {
        return $this->iDoc->IDOC->E1KNA1M->E1KNVVM;
    }

}
