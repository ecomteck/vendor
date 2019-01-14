<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Model;

/**
 * Quote billing address management model
 */
class BillingAddressManagement extends \Magento\Quote\Model\BillingAddressManagement 
    implements \Ecombricks\VendorQuote\Api\BillingAddressManagementInterface 
{
    
    /**
     * Assign
     *
     * @param int $cartId
     * @param int $vendorId
     * @param \Magento\Quote\Api\Data\AddressInterface $address
     * @param bool $useForShipping
     * @return int
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\InputException
     */
    public function vendorAssign($cartId, $vendorId, \Magento\Quote\Api\Data\AddressInterface $address, $useForShipping = false)
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->assign($cartId, $address, $useForShipping);
    }
    
    /**
     * Get
     *
     * @param int $cartId
     * @param int $vendorId
     * @return \Magento\Quote\Api\Data\AddressInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function vendorGet($cartId, $vendorId)
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->get($cartId);
    }
    
}