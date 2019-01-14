<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Model;

/**
 * Checkout shipping information management model
 */
class ShippingInformationManagement extends \Magento\Checkout\Model\ShippingInformationManagement 
    implements \Ecombricks\VendorCheckout\Api\ShippingInformationManagementInterface 
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
    )
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->saveAddressInformation($cartId, $addressInformation);
    }
    
}