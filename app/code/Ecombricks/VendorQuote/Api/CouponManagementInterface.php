<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Api;

/**
 * Quote coupon management interface
 */
interface CouponManagementInterface extends \Magento\Quote\Api\CouponManagementInterface
{
    
    /**
     * Get
     *
     * @param int $cartId
     * @param int $vendorId
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function vendorGet($cartId, $vendorId);
    
    /**
     * Set
     *
     * @param int $cartId
     * @param int $vendorId
     * @param string $couponCode
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function vendorSet($cartId, $vendorId, $couponCode);
    
    /**
     * Remove
     *
     * @param int $cartId
     * @param int $vendorId
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function vendorRemove($cartId, $vendorId);
    
}