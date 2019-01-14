<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Block\Adminhtml\Order\Create\Data;

/**
 * Create order data block vendor trait
 */
trait VendorTrait
{
    
    /**
     * Get vendors
     * 
     * @return \Ecombricks\Vendor\Model\Vendor[]
     */
    public function getVendors()
    {
        return $this->vendorManagement->getAvailableVendors();
    }
    
}