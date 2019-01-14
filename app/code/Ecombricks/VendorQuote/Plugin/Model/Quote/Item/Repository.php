<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorQuote\Plugin\Model\Quote\Item;

/**
 * Quote item repository model plugin
 */
class Repository
{
    
    /**
     * Around get list
     * 
     * @param \Magento\Quote\Model\Quote\Item\Repository $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @return \Magento\Quote\Api\Data\CartItemInterface[]
     */
    public function aroundGetList(
        \Magento\Quote\Model\Quote\Item\Repository $subject,
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
     * @param \Magento\Quote\Model\Quote\Item\Repository $subject
     * @param \Closure $proceed
     * @param \Magento\Quote\Api\Data\CartItemInterface $cartItem
     * @return \Magento\Quote\Api\Data\CartItemInterface
     */
    public function aroundSave(
        \Magento\Quote\Model\Quote\Item\Repository $subject,
        \Closure $proceed,
        \Magento\Quote\Api\Data\CartItemInterface $cartItem
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartItem);
    }
    
    /**
     * Around delete by ID
     * 
     * @param \Magento\Quote\Model\Quote\Item\Repository $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param int $itemId
     * @return bool
     */
    public function aroundDeleteById(
        \Magento\Quote\Model\Quote\Item\Repository $subject,
        \Closure $proceed,
        $cartId,
        $itemId
    )
    {
        $subject->setVendorId($subject->vendorGetVendorId($cartId));
        return $proceed($cartId, $itemId);
    }
    
}