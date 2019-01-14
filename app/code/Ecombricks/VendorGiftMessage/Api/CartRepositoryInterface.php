<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorGiftMessage\Api;

/**
 * Gift message cart repository interface
 */
interface CartRepositoryInterface extends \Magento\GiftMessage\Api\CartRepositoryInterface 
{
    
    /**
     * Get
     * 
     * @param int $cartId
     * @param int $vendorId
     * @return \Magento\GiftMessage\Api\Data\MessageInterface
     */
    public function vendorGet($cartId, $vendorId);
    
    /**
     * Save
     * 
     * @param int $cartId
     * @param int $vendorId
     * @param \Magento\GiftMessage\Api\Data\MessageInterface $giftMessage
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\State\InvalidTransitionException
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function vendorSave($cartId, $vendorId, \Magento\GiftMessage\Api\Data\MessageInterface $giftMessage);
    
}