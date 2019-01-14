<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Framework\Model;

/**
 * Model vendor flag trait
 */
trait VendorFlagTrait
{
    
    /**
     * After load is vendor
     * 
     * @var int
     */
    protected $afterLoadIsVendor;
    
    /**
     * Set is vendor
     * 
     * @param int $isVendor
     * @return $this
     */
    public function setIsVendor($isVendor)
    {
        $this->setData('is_vendor', ($isVendor) ? 1 : 0);
        return $this;
    }
    
    /**
     * Get is vendor
     * 
     * @return int
     */
    public function getIsVendor()
    {
        $isVendor = $this->_getData('is_vendor');
        if ($isVendor === null) {
            $this->vendorFlagAfterLoad();
            $isVendor = $this->_getData('is_vendor');
        }
        return $isVendor;
    }
    
    /**
     * Unset is vendor
     * 
     * @return $this
     */
    public function unsIsVendor()
    {
        $this->unsData('is_vendor');
        return $this;
    }
    
    /**
     * Set after load is vendor
     * 
     * @param int $isVendor
     * @return $this
     */
    public function setAfterLoadIsVendor($isVendor)
    {
        $this->afterLoadIsVendor = ($isVendor) ? 1 : 0;
        return $this;
    }
    
    /**
     * Get after load is vendor
     * 
     * @return int
     */
    public function getAfterLoadIsVendor()
    {
        return $this->afterLoadIsVendor;
    }
    
    /**
     * After load
     * 
     * @return $this
     */
    public function vendorFlagAfterLoad()
    {
        $this->_getResource()->loadIsVendor($this);
        return $this;
    }
    
    /**
     * After save
     * 
     * @return $this
     */
    public function vendorFlagAfterSave()
    {
        $this->_getResource()->saveIsVendor($this);
        return $this;
    }
    
    /**
     * Before delete
     * 
     * @return $this
     */
    public function vendorFlagBeforeDelete()
    {
        $this->_getResource()->deleteIsVendor($this);
        return $this;
    }
    
}