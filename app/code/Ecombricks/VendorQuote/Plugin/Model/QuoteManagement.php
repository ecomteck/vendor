<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorQuote\Plugin\Model;

/**
 * Quote management model plugin
 */
class QuoteManagement
{
    
    /**
     * Around assign customer
     * 
     * @param \Magento\Quote\Model\QuoteManagement $subject
     * @param \Closure $proceed
     * @param int $cartId
     * @param int $customerId
     * @param int $storeId
     * @return bool
     */
    public function aroundAssignCustomer(
        \Magento\Quote\Model\QuoteManagement $subject, 
        \Closure $proceed, 
        $cartId, 
        $customerId, 
        $storeId
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $customerId, $storeId);
    }
    
    /**
     * Around place order
     * 
     * @param \Magento\Quote\Model\QuoteManagement $subject
     * @param \Closure $proceed
     * @param int $cartId
     * @param \Magento\Quote\Api\Data\PaymentInterface|null $paymentMethod
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @return int
     */
    public function aroundPlaceOrder(
        \Magento\Quote\Model\QuoteManagement $subject, 
        \Closure $proceed,
        $cartId, 
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod = null
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $paymentMethod);
    }
    
}