<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorQuote\Plugin\Model\GuestCart;

/**
 * Guest cart total repository model plugin
 */
class GuestCartTotalRepository
{
    
    /**
     * Around get
     * 
     * @param \Magento\Quote\Model\GuestCart\GuestCartTotalRepository $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @return \Magento\Quote\Api\Data\TotalsInterface
     */
    public function aroundGet(
        \Magento\Quote\Model\GuestCart\GuestCartTotalRepository $subject,
        \Closure $proceed,
        $cartId
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId);
    }
    
}
