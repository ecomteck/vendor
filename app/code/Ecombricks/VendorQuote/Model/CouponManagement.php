<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Model;

/**
 * Quote coupon management model
 */
class CouponManagement extends \Magento\Quote\Model\CouponManagement 
    implements \Ecombricks\VendorQuote\Api\CouponManagementInterface
{
    
    /**
     * Get
     *
     * @param int $cartId
     * @param int $vendorId
     * @return string
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
    public function vendorSet($cartId, $vendorId, $couponCode)
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->set($cartId, $couponCode);
    }
    
    /**
     * Remove
     *
     * @param int $cartId
     * @param int $vendorId
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function vendorRemove($cartId, $vendorId)
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->remove($cartId);
    }
    
}