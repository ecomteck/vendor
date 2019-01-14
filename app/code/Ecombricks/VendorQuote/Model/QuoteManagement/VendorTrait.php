<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Model\QuoteManagement;

/**
 * Quote management model vendor trait
 */
trait VendorTrait
{
    
    /**
     * Get cart for customer
     * 
     * @param int $vendorId
     * @param int $customerId
     * @return \Magento\Quote\Api\Data\CartInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function vendorGetCartForCustomer($vendorId, $customerId)
    {
        $this->setVendorId($vendorId);
        return $this->getCartForCustomer($customerId);
    }
    
}