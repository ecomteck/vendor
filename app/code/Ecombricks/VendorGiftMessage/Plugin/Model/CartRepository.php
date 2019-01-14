<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorGiftMessage\Plugin\Model;

/**
 * Gift message cart repository model plugin
 */
class CartRepository
{
    
    /**
     * Around get
     * 
     * @param \Magento\GiftMessage\Model\CartRepository $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @return \Magento\GiftMessage\Api\Data\MessageInterface
     */
    public function aroundGet(
        \Magento\GiftMessage\Model\CartRepository $subject,
        \Closure $proceed,
        $cartId
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId);
    }
    
    /**
     * Around save
     * 
     * @param \Magento\GiftMessage\Model\CartRepository $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param \Magento\GiftMessage\Api\Data\MessageInterface $giftMessage
     * @return bool
     */
    public function aroundSave(
        \Magento\GiftMessage\Model\CartRepository $subject,
        \Closure $proceed,
        $cartId,
        \Magento\GiftMessage\Api\Data\MessageInterface $giftMessage
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $giftMessage);
    }
    
}