<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorGiftMessage\Plugin\Model;

/**
 * Guest gift message item repository model plugin
 */
class GuestItemRepository
{
    
    /**
     * Around get
     * 
     * @param \Magento\GiftMessage\Model\GuestItemRepository $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param int $itemId
     * @return \Magento\GiftMessage\Api\Data\MessageInterface
     */
    public function aroundGet(
        \Magento\GiftMessage\Model\GuestItemRepository $subject,
        \Closure $proceed,
        $cartId,
        $itemId
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $itemId);
    }
    
    /**
     * Around save
     * 
     * @param \Magento\GiftMessage\Model\GuestCartRepository $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param \Magento\GiftMessage\Api\Data\MessageInterface $giftMessage
     * @param int $itemId
     * @return bool
     */
    public function aroundSave(
        \Magento\GiftMessage\Model\GuestCartRepository $subject,
        \Closure $proceed,
        $cartId,
        \Magento\GiftMessage\Api\Data\MessageInterface $giftMessage,
        $itemId
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $giftMessage, $itemId);
    }
    
}