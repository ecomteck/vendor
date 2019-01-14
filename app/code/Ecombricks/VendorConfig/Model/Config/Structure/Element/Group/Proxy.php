<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorConfig\Model\Config\Structure\Element\Group;

/**
 * Config structure group element proxy model
 */
class Proxy extends \Magento\Config\Model\Config\Structure\Element\Group\Proxy
{
    
    /**
     * Vendor ID
     * 
     * @var int
     */
    protected $vendorId;
    
    /**
     * Set subject vendor ID
     * 
     * @return $this
     */
    protected function setSubjectVendorId()
    {
        $this->_getSubject()->setVendorId($this->vendorId);
        return $this;
    }
    
    /**
     * Set vendor ID
     * 
     * @param int $vendorId
     * @return $this
     */
    public function setVendorId($vendorId)
    {
        $this->vendorId = $vendorId;
        return $this;
    }
    
    /**
     * Get vendor ID
     * 
     * @return int
     */
    public function getVendorId()
    {
        return $this->vendorId;
    }
    
    /**
     * Check if is enabled for vendor
     * 
     * @return bool
     */
    public function isEnabledForVendor()
    {
        $this->setSubjectVendorId();
        return $this->_getSubject()->isEnabledForVendor();
    }
    
    /**
     * Check if is enabled for vendor only
     * 
     * @return bool
     */
    public function isEnabledForVendorOnly()
    {
        $this->setSubjectVendorId();
        return $this->_getSubject()->isEnabledForVendorOnly();
    }
    
}