<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorQuote\Plugin\Model\GuestCart;

/**
 * Guest cart repository model plugin
 */
class GuestCartRepository
{
    
    /**
     * Around get
     * 
     * @param \Magento\Quote\Model\GuestCart\GuestCartRepository $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @return \Magento\Quote\Api\Data\CartInterface
     */
    public function aroundGet(
        \Magento\Quote\Model\GuestCart\GuestCartRepository $subject,
        \Closure $proceed,
        $cartId
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId);
    }
    
}
