<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Api;

/**
 * Checkout shipping information management interface
 */
interface ShippingInformationManagementInterface extends \Magento\Checkout\Api\ShippingInformationManagementInterface
{
    
    /**
     * Save address information
     * 
     * @param int $cartId
     * @param int $vendorId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     * @return \Magento\Checkout\Api\Data\PaymentDetailsInterface
     */
    public function vendorSaveAddressInformation(
        $cartId,
        $vendorId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    );
    
}