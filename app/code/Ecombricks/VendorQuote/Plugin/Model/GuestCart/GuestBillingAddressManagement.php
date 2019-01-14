<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorQuote\Plugin\Model\GuestCart;

/**
 * Guest billing address management model plugin
 */
class GuestBillingAddressManagement
{
    
    /**
     * Around assign
     * 
     * @param \Magento\Quote\Model\GuestCart\GuestBillingAddressManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param \Magento\Quote\Api\Data\AddressInterface $address
     * @param bool $useForShipping
     * @return int
     */
    public function aroundAssign(
        \Magento\Quote\Model\GuestCart\GuestBillingAddressManagement $subject,
        \Closure $proceed,
        $cartId,
        \Magento\Quote\Api\Data\AddressInterface $address,
        $useForShipping = false
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $address, $useForShipping);
    }
    
    /**
     * Around get
     * 
     * @param \Magento\Quote\Model\GuestCart\GuestBillingAddressManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @return \Magento\Quote\Api\Data\AddressInterface
     */
    public function aroundGet(
        \Magento\Quote\Model\GuestCart\GuestBillingAddressManagement $subject,
        \Closure $proceed,
        $cartId
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId);
    }
    
}
