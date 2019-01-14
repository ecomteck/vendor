<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Model\Quote;

/**
 * Quote model vendor trait
 */
trait VendorTrait
{
    
    /**
     * Load by customer
     * 
     * @param int $vendorId
     * @param int $customerId
     * @return $this
     */
    public function vendorLoadByCustomer($vendorId, $customerId)
    {
        $this->_getResource()->vendorLoadByCustomer($this, $vendorId, $customerId);
        $this->_afterLoad();
        return $this;
    }
    
    /**
     * Get vendor IDs by customer
     * 
     * @param int $customerId
     * @return array
     */
    public function getVendorIdsByCustomerId($customerId)
    {
        return $this->_getResource()->getVendorIdsByCustomerId($this, $customerId);
    }
    
    /**
     * Remove non-vendor items
     * 
     * @return $this
     */
    public function removeNonVendorItems()
    {
        $hasItemsRemoved = false;
        $vendorId = $this->getVendorId();
        foreach ($this->getAllVisibleItems() as $item) {
            $itemVendorId = $item->getProduct()->getVendorId();
            if ($itemVendorId != $vendorId) {
                $this->removeItem($item->getId());
                $hasItemsRemoved = true;
            }
        }
        if ($hasItemsRemoved) {
            $this->setTotalsCollectedFlag(false);
            $this->collectTotals();
            $this->save();
        }
        return $this;
    }
    
    /**
     * Model after load
     * 
     * @return $this
     */
    public function vendorModelAfterLoad()
    {
        $this->removeNonVendorItems();
        return $this;
    }
    
}