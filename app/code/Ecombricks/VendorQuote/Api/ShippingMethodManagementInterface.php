<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Api;

/**
 * Quote shipping method management interface
 */
interface ShippingMethodManagementInterface extends \Magento\Quote\Api\ShippingMethodManagementInterface
{
    
    /**
     * Estimate by address
     *
     * @param int $cartId
     * @param int $vendorId
     * @param \Magento\Quote\Api\Data\EstimateAddressInterface $address
     * @return \Magento\Quote\Api\Data\ShippingMethodInterface[]
     */
    public function vendorEstimateByAddress($cartId, $vendorId, \Magento\Quote\Api\Data\EstimateAddressInterface $address);
    
    /**
     * Estimate by address ID
     *
     * @param int $cartId
     * @param int $vendorId
     * @param int $addressId
     * @return \Magento\Quote\Api\Data\ShippingMethodInterface[]
     */
    public function vendorEstimateByAddressId($cartId, $vendorId, $addressId);
    
    /**
     * Get list
     *
     * @param int $cartId
     * @param int $vendorId
     * @return \Magento\Quote\Api\Data\ShippingMethodInterface[]
     */
    public function vendorGetList($cartId, $vendorId);
    
    
}