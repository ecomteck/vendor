<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Model;

/**
 * Quote payment method management model
 */
class PaymentMethodManagement extends \Magento\Quote\Model\PaymentMethodManagement 
    implements \Ecombricks\VendorQuote\Api\PaymentMethodManagementInterface 
{
    
    /**
     * Set
     *
     * @param int $cartId
     * @param int $vendorId
     * @param \Magento\Quote\Api\Data\PaymentInterface $method
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\State\InvalidTransitionException
     */
    public function vendorSet($cartId, $vendorId, \Magento\Quote\Api\Data\PaymentInterface $method)
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->set($cartId, $method);
    }
    
    /**
     * Get
     *
     * @param int $cartId The cart ID
     * @param int $vendorId
     * @return \Magento\Quote\Api\Data\PaymentInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function vendorGet($cartId, $vendorId)
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->get($cartId);
    }

    /**
     * Get list
     *
     * @param int $cartId
     * @param int $vendorId
     * @return \Magento\Quote\Api\Data\PaymentMethodInterface[]
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function vendorGetList($cartId, $vendorId)
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->getList($cartId);
    }
    
}