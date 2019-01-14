<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorQuote\Plugin\Model\GuestCart;

/**
 * Guest shipping address management model plugin
 */
class GuestShippingAddressManagement
{
    
    /**
     * Around assign
     * 
     * @param \Magento\Quote\Model\GuestCart\GuestShippingAddressManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param \Magento\Quote\Api\Data\AddressInterface $address
     * @return int
     */
    public function aroundAssign(
        \Magento\Quote\Model\GuestCart\GuestShippingAddressManagement $subject,
        \Closure $proceed,
        $cartId,
        \Magento\Quote\Api\Data\AddressInterface $address
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $address);
    }
    
    /**
     * Around get
     * 
     * @param \Magento\Quote\Model\GuestCart\GuestShippingAddressManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @return \Magento\Quote\Api\Data\AddressInterface
     */
    public function aroundGet(
        \Magento\Quote\Model\GuestCart\GuestShippingAddressManagement $subject,
        \Closure $proceed,
        $cartId
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId);
    }
    
}
