<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorQuote\Plugin\Model\GuestCart;

/**
 * Guest cart management model plugin
 */
class GuestCartManagement
{
    
    /**
     * Around assign customer
     * 
     * @param \Magento\Quote\Model\GuestCart\GuestCartManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param int $customerId
     * @param int $storeId
     * @return boolean
     */
    public function aroundAssignCustomer(
        \Magento\Quote\Model\GuestCart\GuestCartManagement $subject,
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
     * @param \Magento\Quote\Model\GuestCart\GuestCartManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param \Magento\Quote\Api\Data\PaymentInterface|null $paymentMethod
     * @return int
     */
    public function aroundPlaceOrder(
        \Magento\Quote\Model\GuestCart\GuestCartManagement $subject,
        \Closure $proceed,
        $cartId,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod = null
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $paymentMethod);
    }
    
}
