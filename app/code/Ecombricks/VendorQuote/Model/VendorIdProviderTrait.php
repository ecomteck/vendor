<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Model;

/**
 * Vendor ID provider model trait
 */
trait VendorIdProviderTrait
{
    
    /**
     * Get vendor ID
     * 
     * @param int $cartId
     * @return mixed
     */
    public function vendorGetVendorId($cartId)
    {
        return $this->vendorCartRepository->getVendorIdByQuoteId($cartId);
    }
    
}