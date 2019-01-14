<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorQuote\Plugin\Model;

/**
 * Coupon management model plugin
 */
class CouponManagement
{
    
    /**
     * Around get
     * 
     * @param \Magento\Quote\Model\CouponManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @return string
     */
    public function aroundGet(
        \Magento\Quote\Model\CouponManagement $subject,
        \Closure $proceed,
        $cartId
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId);
    }
    
    /**
     * Around set
     * 
     * @param \Magento\Quote\Model\CouponManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param string $couponCode
     * @return bool
     */
    public function aroundSet(
        \Magento\Quote\Model\CouponManagement $subject,
        \Closure $proceed,
        $cartId,
        $couponCode
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $couponCode);
    }
    
    /**
     * Around remove
     * 
     * @param \Magento\Quote\Model\CouponManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @return bool
     */
    public function aroundRemove(
        \Magento\Quote\Model\CouponManagement $subject,
        \Closure $proceed,
        $cartId
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId);
    }
    
}