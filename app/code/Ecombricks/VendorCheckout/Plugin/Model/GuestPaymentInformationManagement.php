<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Plugin\Model;

/**
 * Guest payment information management model plugin
 */
class GuestPaymentInformationManagement
{
    
    /**
     * Around save payment information and place order
     * 
     * @param \Magento\Checkout\Model\GuestPaymentInformationManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param string $email
     * @param \Magento\Quote\Api\Data\PaymentInterface $paymentMethod
     * @param \Magento\Quote\Api\Data\AddressInterface|null $billingAddress
     * @return int
     */
    public function aroundSavePaymentInformationAndPlaceOrder(
        \Magento\Checkout\Model\GuestPaymentInformationManagement $subject,
        \Closure $proceed,
        $cartId,
        $email,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod,
        \Magento\Quote\Api\Data\AddressInterface $billingAddress = null
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $email, $paymentMethod, $billingAddress);
    }
    
    /**
     * Around save payment information
     * 
     * @param \Magento\Checkout\Model\GuestPaymentInformationManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param string $email
     * @param \Magento\Quote\Api\Data\PaymentInterface $paymentMethod
     * @param \Magento\Quote\Api\Data\AddressInterface|null $billingAddress
     * @return int
     */
    public function aroundSavePaymentInformation(
        \Magento\Checkout\Model\GuestPaymentInformationManagement $subject,
        \Closure $proceed,
        $cartId,
        $email,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod,
        \Magento\Quote\Api\Data\AddressInterface $billingAddress = null
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $email, $paymentMethod, $billingAddress);
    }
    
    /**
     * Around get payment information
     * 
     * @param \Magento\Checkout\Model\GuestPaymentInformationManagement $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @return \Magento\Checkout\Api\Data\PaymentDetailsInterface
     */
    public function aroundGetPaymentInformation(
        \Magento\Checkout\Model\GuestPaymentInformationManagement $subject,
        \Closure $proceed,
        $cartId
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId);
    }
    
}
