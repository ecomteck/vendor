<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Plugin\Model;

/**
 * Shipping information management model plugin
 */
class ShippingInformationManagement
{
    
    /**
     * Around save address information
     * 
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     * @return \Magento\Checkout\Api\Data\PaymentDetailsInterface
     */
    public function aroundSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        \Closure $proceed,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $addressInformation);
    }
    
}
