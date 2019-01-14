<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Model;

/**
 * Quote shipping method management model
 */
class ShippingMethodManagement extends \Magento\Quote\Model\ShippingMethodManagement 
    implements \Ecombricks\VendorQuote\Api\ShipmentEstimationInterface, \Ecombricks\VendorQuote\Api\ShippingMethodManagementInterface 
{

    /**
     * Get list
     *
     * @param int $cartId
     * @param int $vendorId
     * @return \Magento\Quote\Api\Data\ShippingMethodInterface[]
     */
    public function vendorGetList($cartId, $vendorId)
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->getList($cartId);
    }

    /**
     * Estimate by address
     *
     * @param int $cartId
     * @param int $vendorId
     * @param \Magento\Quote\Api\Data\EstimateAddressInterface $address
     * @return \Magento\Quote\Api\Data\ShippingMethodInterface[]
     */
    public function vendorEstimateByAddress($cartId, $vendorId, \Magento\Quote\Api\Data\EstimateAddressInterface $address)
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->estimateByAddress($cartId, $address);
    }

    /**
     * Estimate by extended address
     * 
     * @param mixed $cartId
     * @param mixed $vendorId
     * @param AddressInterface $address
     * @return \Magento\Quote\Api\Data\ShippingMethodInterface[]
     */
    public function vendorEstimateByExtendedAddress($cartId, $vendorId, \Magento\Quote\Api\Data\AddressInterface $address)
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->estimateByExtendedAddress($cartId, $address);
    }

    /**
     * Estimate by address ID
     *
     * @param int $cartId
     * @param int $vendorId
     * @param int $addressId
     * @return \Magento\Quote\Api\Data\ShippingMethodInterface[]
     */
    public function vendorEstimateByAddressId($cartId, $vendorId, $addressId)
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->estimateByAddressId($cartId, $addressId);
    }

}