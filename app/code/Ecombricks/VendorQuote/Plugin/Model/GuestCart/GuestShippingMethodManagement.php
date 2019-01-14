<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorQuote\Plugin\Model\GuestCart;

/**
 * Guest shipping method management model plugin
 */
class GuestShippingMethodManagement
{
    
    /**
     * Around get
     * 
     * @param \Magento\Quote\Model\GuestCart\GuestShippingMethodManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @return \Magento\Quote\Api\Data\ShippingMethodInterface
     */
    public function aroundGet(
        \Magento\Quote\Model\GuestCart\GuestShippingMethodManagement $subject,
        \Closure $proceed,
        $cartId
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId);
    }
    
    /**
     * Around set
     * 
     * @param \Magento\Quote\Model\GuestCart\GuestShippingMethodManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param string $carrierCode
     * @param string $methodCode
     * @return bool
     */
    public function aroundSet(
        \Magento\Quote\Model\GuestCart\GuestShippingMethodManagement $subject,
        \Closure $proceed,
        $cartId,
        $carrierCode,
        $methodCode
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $carrierCode, $methodCode);
    }
    
    /**
     * Around get list
     * 
     * @param \Magento\Quote\Model\GuestCart\GuestShippingMethodManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @return \Magento\Quote\Api\Data\ShippingMethodInterface[]
     */
    public function aroundGetList(
        \Magento\Quote\Model\GuestCart\GuestShippingMethodManagement $subject,
        \Closure $proceed,
        $cartId
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId);
    }
    
    /**
     * Around estimate by address
     * 
     * @param \Magento\Quote\Model\GuestCart\GuestShippingMethodManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param \Magento\Quote\Api\Data\EstimateAddressInterface $address
     * @return \Magento\Quote\Api\Data\ShippingMethodInterface[]
     */
    public function aroundEstimateByAddress(
        \Magento\Quote\Model\GuestCart\GuestShippingMethodManagement $subject,
        \Closure $proceed,
        $cartId,
        \Magento\Quote\Api\Data\EstimateAddressInterface $address
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $address);
    }
    
    /**
     * Around estimate by extended address
     * 
     * @param \Magento\Quote\Model\GuestCart\GuestShippingMethodManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param \Magento\Quote\Api\Data\AddressInterface $address
     * @return \Magento\Quote\Api\Data\ShippingMethodInterface[]
     */
    public function aroundEstimateByExtendedAddress(
        \Magento\Quote\Model\GuestCart\GuestShippingMethodManagement $subject,
        \Closure $proceed,
        $cartId,
        \Magento\Quote\Api\Data\AddressInterface $address
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $address);
    }
    
}
