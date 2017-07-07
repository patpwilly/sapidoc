<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace patpwilly\sapidoc\classes;

/**
 * Description of DEBMAS07_E1KNVVM
 *
 * @author pwilliamson
 */
class DEBMAS07_E1KNVVM{
    use \patpwilly\sapidoc\traits\TraitsXml;
    public $iDoc;
    public function __construct(\SimpleXMLElement $x)
    {
        $this->iDoc = $x;
    }
    public function getFunction()
    {
        return $this->iDoc->MSGFN;
    }
    public function getSalesOrganization()
    {
        return $this->iDoc->VKORG;
    }
    public function getDistributionChannel()
    {
        return $this->iDoc->VTWEG;
    }
    public function getDivision()
    {
        return $this->iDoc->SPART;
    }
    public function getAuthorizationGroup()
    {
        return $this->iDoc->BEGRU;
    }
    public function getDeletionFlagForCustomer()
    {
        return $this->iDoc->LOEVM;
    }
    public function getCustomerStatisticsGroup()
    {
        return $this->iDoc->VERSG;
    }
    public function getPricingProcedure()
    {
        return $this->iDoc->KALKS;
    }
    public function getCustomerGroup()
    {
        return $this->iDoc->KDGRP;
    }
    public function getSalesDistrict()
    {
        return $this->iDoc->BZIRK;
    }
    public function getPriceGroup()
    {
        return $this->iDoc->KONDA;
    }
    public function getPriceListType()
    {
        return $this->iDoc->PLTYP;
    }
    public function getCurrency()
    {
        return $this->iDoc->WAERS;
    }
    public function getAccountAssignmentGroup()
    {
        return $this->iDoc->KTGRD;
    }
    public function getSalesGroup()
    {
        return $this->iDoc->VKGRP;
    }
    public function getSalesOffice()
    {
        return $this->iDoc->VKBUR;
    }
    public function getClassification()
    {
        return $this->iDoc->KLABC;
    }
}
