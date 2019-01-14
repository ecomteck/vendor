<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Plugin\Model;

/**
 * Guest shipping information management model plugin
 */
class GuestShippingInformationManagement
{
    
    /**
     * Around save address information
     * 
     * @param \Magento\Checkout\Model\GuestShippingInformationManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     * @return \Magento\Checkout\Api\Data\PaymentDetailsInterface
     */
    public function aroundSaveAddressInformation(
        \Magento\Checkout\Model\GuestShippingInformationManagement $subject,
        \Closure $proceed,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $addressInformation);
    }
    
}
