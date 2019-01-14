<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorQuote\Plugin\Model;

/**
 * Payment method management model plugin
 */
class PaymentMethodManagement
{
    
    /**
     * Around set
     * 
     * @param \Magento\Quote\Model\PaymentMethodManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param \Magento\Quote\Api\Data\PaymentInterface $method
     * @return int
     */
    public function aroundSet(
        \Magento\Quote\Model\PaymentMethodManagement $subject,
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
     * @param \Magento\Quote\Model\PaymentMethodManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @return \Magento\Quote\Api\Data\PaymentInterface
     */
    public function aroundGet(
        \Magento\Quote\Model\PaymentMethodManagement $subject,
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
     * @param \Magento\Quote\Model\PaymentMethodManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @return \Magento\Quote\Api\Data\PaymentMethodInterface[]
     */
    public function aroundGetList(
        \Magento\Quote\Model\PaymentMethodManagement $subject,
        \Closure $proceed,
        $cartId
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId);
    }
    
}