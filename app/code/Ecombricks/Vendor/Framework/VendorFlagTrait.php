<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Framework;

/**
 * Vendor flag trait
 */
trait VendorFlagTrait
{
    
    /**
     * Is vendor
     * 
     * @var int
     */
    protected $isVendor;
    
    /**
     * Set is vendor
     * 
     * @param int $isVendor
     * @return $this
     */
    public function setIsVendor($isVendor)
    {
        $this->isVendor = ($isVendor) ? 1 : 0;
        $this->afterSetIsVendor();
        return $this;
    }
    
    /**
     * Get is vendor
     * 
     * @return int
     */
    public function getIsVendor()
    {
        return $this->isVendor;
    }
    
    /**
     * Unset is vendor
     * 
     * @return $this
     */
    public function unsIsVendor()
    {
        $this->isVendor = null;
        return $this;
    }
    
    /**
     * Check if is vendor
     * 
     * @return bool
     */
    public function isVendor()
    {
        return (bool) $this->getIsVendor();
    }
    
    /**
     * After set is vendor
     * 
     * @return $this
     */
    public function afterSetIsVendor()
    {
        return $this;
    }
    
}