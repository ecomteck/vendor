<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorQuote\Plugin\Model\GuestCart;

/**
 * Guest payment method management model plugin
 */
class GuestPaymentMethodManagement
{
    
    /**
     * Around set
     * 
     * @param \Magento\Quote\Model\GuestCart\GuestPaymentMethodManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param \Magento\Quote\Api\Data\PaymentInterface $method
     * @return int
     */
    public function aroundSet(
        \Magento\Quote\Model\GuestCart\GuestPaymentMethodManagement $subject,
        \Closure $proceed,
        $cartId,
        \Magento\Quote\Api\Data\PaymentInterface $method
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $method);
    }
    
    /**
     * Around get
     * 
     * @param \Magento\Quote\Model\GuestCart\GuestPaymentMethodManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @return \Magento\Quote\Api\Data\PaymentInterface
     */
    public function aroundGet(
        \Magento\Quote\Model\GuestCart\GuestPaymentMethodManagement $subject,
        \Closure $proceed,
        $cartId
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId);
    }
    
    /**
     * Around get list
     * 
     * @param \Magento\Quote\Model\GuestCart\GuestPaymentMethodManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @return \Magento\Quote\Api\Data\PaymentMethodInterface[]
     */
    public function aroundGetList(
        \Magento\Quote\Model\GuestCart\GuestPaymentMethodManagement $subject,
        \Closure $proceed,
        $cartId
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId);
    }
    
}