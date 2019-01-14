<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorGiftMessage\Plugin\Model;

/**
 * Guest gift message cart repository model plugin
 */
class GuestCartRepository
{
    
    /**
     * Around get
     * 
     * @param \Magento\GiftMessage\Model\GuestCartRepository $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @return \Magento\GiftMessage\Api\Data\MessageInterface
     */
    public function aroundGet(
        \Magento\GiftMessage\Model\GuestCartRepository $subject,
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
     * @param \Magento\GiftMessage\Model\GuestCartRepository $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param \Magento\GiftMessage\Api\Data\MessageInterface $giftMessage
     * @return bool
     */
    public function aroundSave(
        \Magento\GiftMessage\Model\GuestCartRepository $subject,
        \Closure $proceed,
        $cartId,
        \Magento\GiftMessage\Api\Data\MessageInterface $giftMessage
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $giftMessage);
    }
    
}