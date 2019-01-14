<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Api;

/**
 * Quote billing address management interface
 */
interface BillingAddressManagementInterface extends \Magento\Quote\Api\BillingAddressManagementInterface
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
    public function vendorAssign($cartId, $vendorId, \Magento\Quote\Api\Data\AddressInterface $address, $useForShipping = false);
    
    /**
     * Get
     *
     * @param int $cartId
     * @param int $vendorId
     * @return \Magento\Quote\Api\Data\AddressInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function vendorGet($cartId, $vendorId);
    
}