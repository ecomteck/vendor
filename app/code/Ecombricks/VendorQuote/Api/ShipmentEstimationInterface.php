<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Api;

/**
 * Quote shipment estimation interface
 */
interface ShipmentEstimationInterface extends \Magento\Quote\Api\ShipmentEstimationInterface
{
    
    /**
     * Estimate by extended address
     * 
     * @param mixed $cartId
     * @param mixed $vendorId
     * @param AddressInterface $address
     * @return \Magento\Quote\Api\Data\ShippingMethodInterface[]
     */
    public function vendorEstimateByExtendedAddress($cartId, $vendorId, \Magento\Quote\Api\Data\AddressInterface $address);
    
}