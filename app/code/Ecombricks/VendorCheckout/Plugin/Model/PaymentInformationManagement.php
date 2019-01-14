<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Plugin\Model;

/**
 * Payment information management model plugin
 */
class PaymentInformationManagement
{
    
    /**
     * Around save payment information and place order
     * 
     * @param \Magento\Checkout\Model\PaymentInformationManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param \Magento\Quote\Api\Data\PaymentInterface $paymentMethod
     * @param \Magento\Quote\Api\Data\AddressInterface|null $billingAddress
     * @return int
     */
    public function aroundSavePaymentInformationAndPlaceOrder(
        \Magento\Checkout\Model\PaymentInformationManagement $subject,
        \Closure $proceed,
        $cartId,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod,
        \Magento\Quote\Api\Data\AddressInterface $billingAddress = null
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $paymentMethod, $billingAddress);
    }
    
    /**
     * Around save payment information
     * 
     * @param \Magento\Checkout\Model\PaymentInformationManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param \Magento\Quote\Api\Data\PaymentInterface $paymentMethod
     * @param \Magento\Quote\Api\Data\AddressInterface|null $billingAddress
     * @return int
     */
    public function aroundSavePaymentInformation(
        \Magento\Checkout\Model\PaymentInformationManagement $subject,
        \Closure $proceed,
        $cartId,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod,
        \Magento\Quote\Api\Data\AddressInterface $billingAddress = null
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $paymentMethod, $billingAddress);
    }
    
    /**
     * Around get payment information
     * 
     * @param \Magento\Checkout\Model\PaymentInformationManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @return \Magento\Checkout\Api\Data\PaymentDetailsInterface
     */
    public function aroundGetPaymentInformation(
        \Magento\Checkout\Model\PaymentInformationManagement $subject,
        \Closure $proceed,
        $cartId
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId);
    }
    
}
