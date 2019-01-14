<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Api;

/**
 * Quote cart total repository interface
 */
interface CartTotalRepositoryInterface extends \Magento\Quote\Api\CartTotalRepositoryInterface
{
    
    /**
     * Get
     * 
     * @param int $cartId
     * @param int $vendorId
     * @return \Magento\Quote\Api\Data\TotalsInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function vendorGet($cartId, $vendorId);
    
}