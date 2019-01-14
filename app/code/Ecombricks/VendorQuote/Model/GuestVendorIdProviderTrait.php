<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Model;

/**
 * Guest vendor ID provider model trait
 */
trait GuestVendorIdProviderTrait
{
    
    /**
     * Get vendor ID
     * 
     * @param string $cartId
     * @return mixed
     */
    public function vendorGetVendorId($cartId)
    {
        $quoteIdMask = $this->vendorQuoteIdMaskFactory->create()->load($cartId, 'masked_id');
        return $this->vendorCartRepository->getVendorIdByQuoteId($quoteIdMask->getQuoteId());
    }
    
}