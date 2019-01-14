<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Model;

/**
 * Checkout payment information management model
 */
class PaymentInformationManagement extends \Magento\Checkout\Model\PaymentInformationManagement 
    implements \Ecombricks\VendorCheckout\Api\PaymentInformationManagementInterface 
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
    )
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->savePaymentInformationAndPlaceOrder($cartId, $paymentMethod, $billingAddress);
    }
    
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
    )
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->savePaymentInformation($cartId, $paymentMethod, $billingAddress);
    }
    
    /**
     * Get payment information
     * 
     * @param int $cartId
     * @param int $vendorId
     * @return \Magento\Checkout\Api\Data\PaymentDetailsInterface
     */
    public function vendorGetPaymentInformation($cartId, $vendorId)
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->getPaymentInformation($cartId);
    }
    
}