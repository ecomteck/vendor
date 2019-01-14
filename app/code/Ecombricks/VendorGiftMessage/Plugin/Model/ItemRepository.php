<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorGiftMessage\Plugin\Model;

/**
 * Gift message item repository model plugin
 */
class ItemRepository
{
    
    /**
     * Around get
     * 
     * @param \Magento\GiftMessage\Model\ItemRepository $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param int $itemId
     * @return \Magento\GiftMessage\Api\Data\MessageInterface
     */
    public function aroundGet(
        \Magento\GiftMessage\Model\ItemRepository $subject,
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
     * @param \Magento\GiftMessage\Model\ItemRepository $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param \Magento\GiftMessage\Api\Data\MessageInterface $giftMessage
     * @param int $itemId
     * @return bool
     */
    public function aroundSave(
        \Magento\GiftMessage\Model\ItemRepository $subject,
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