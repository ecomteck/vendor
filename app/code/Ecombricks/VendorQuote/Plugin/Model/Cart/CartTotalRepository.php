<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorQuote\Plugin\Model\Cart;

/**
 * Cart total repository model plugin
 */
class CartTotalRepository
{
    
    /**
     * Around get
     * 
     * @param \Magento\Quote\Model\Cart\CartTotalRepository $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @return \Magento\Quote\Api\Data\TotalsInterface
     */
    public function aroundGet(
        \Magento\Quote\Model\Cart\CartTotalRepository $subject,
        \Closure $proceed,
        $cartId
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId);
    }
    
}