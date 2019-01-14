<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Model;

/**
 * Quote management model
 */
class QuoteManagement extends \Magento\Quote\Model\QuoteManagement 
    implements \Ecombricks\VendorQuote\Api\CartManagementInterface 
{
    
    /**
     * Create empty cart
     * 
     * @param int $vendorId
     * @return int
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function vendorCreateEmptyCart($vendorId)
    {
        $this->setVendorId($vendorId);
        return $this->createEmptyCart();
    }

    /**
     * Create empty cart for customer
     * 
     * @param int $vendorId
     * @param int $customerId
     * @return int
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function vendorCreateEmptyCartForCustomer($vendorId, $customerId)
    {
        $this->setVendorId($vendorId);
        return $this->createEmptyCartForCustomer($customerId);
    }
    
    /**
     * Get cart for customer
     * 
     * @param int $vendorId
     * @param int $customerId
     * @return \Magento\Quote\Api\Data\CartInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function vendorGetCartForCustomer($vendorId, $customerId)
    {
        $this->setVendorId($vendorId);
        return $this->getCartForCustomer($customerId);
    }
    
    /**
     * Assign customer
     *
     * @param int $cartId
     * @param int $vendorId
     * @param int $customerId
     * @param int $storeId
     * @return bool
     */
    public function vendorAssignCustomer($cartId, $vendorId, $customerId, $storeId)
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->assignCustomer($cartId, $customerId, $storeId);
    }

    /**
     * Place order
     *
     * @param int $cartId
     * @param int $vendorId
     * @param \Magento\Quote\Api\Data\PaymentInterface|null $paymentMethod
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @return int
     */
    public function vendorPlaceOrder($cartId, $vendorId, \Magento\Quote\Api\Data\PaymentInterface $paymentMethod = null)
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->placeOrder($cartId, $paymentMethod);
    }
    
}