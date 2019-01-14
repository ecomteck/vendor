<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Api;

/**
 * Checkout payment information management interface
 */
interface PaymentInformationManagementInterface extends \Magento\Checkout\Api\PaymentInformationManagementInterface 
{
    
    /**
     * Save payment information and place order
     *
     * @param int $cartId
     * @param int $vendorId
     * @param \Magento\Quote\Api\Data\PaymentInterface $paymentMethod
     * @param \Magento\Quote\Api\Data\AddressInterface|null $billingAddress
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @return int Order ID.
     */
    public function vendorSavePaymentInformationAndPlaceOrder(
        $cartId,
        $vendorId,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod,
        \Magento\Quote\Api\Data\AddressInterface $billingAddress = null
    );
    
    /**
     * Save payment information
     *
     * @param int $cartId
     * @param int $vendorId
     * @param \Magento\Quote\Api\Data\PaymentInterface $paymentMethod
     * @param \Magento\Quote\Api\Data\AddressInterface|null $billingAddress
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @return int
     */
    public function vendorSavePaymentInformation(
        $cartId,
        $vendorId,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod,
        \Magento\Quote\Api\Data\AddressInterface $billingAddress = null
    );
    
    /**
     * Get payment information
     * 
     * @param int $cartId
     * @param int $vendorId
     * @return \Magento\Checkout\Api\Data\PaymentDetailsInterface
     */
    public function vendorGetPaymentInformation($cartId, $vendorId);
    
}