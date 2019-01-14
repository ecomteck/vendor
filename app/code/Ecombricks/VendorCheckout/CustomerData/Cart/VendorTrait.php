<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCheckout\CustomerData\Cart;

/**
 * Cart customer data vendor trait
 */
trait VendorTrait
{
    
    /**
     * After set vendor ID
     * 
     * @param int $vendorId
     * @return $this
     */
    public function afterSetVendorId($vendorId)
    {
        $this->quote = null;
        $this->summeryCount = null;
        $this->setCustomQuote(null);
        return $this;
    }
    
}