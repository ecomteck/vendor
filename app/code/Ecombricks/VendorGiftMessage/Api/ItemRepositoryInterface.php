<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorGiftMessage\Api;

/**
 * Gift message item repository interface
 */
interface ItemRepositoryInterface extends \Magento\GiftMessage\Api\ItemRepositoryInterface 
{
    
    /**
     * Get
     *
     * @param int $cartId
     * @param int $vendorId
     * @param int $itemId
     * @return \Magento\GiftMessage\Api\Data\MessageInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function vendorGet($cartId, $vendorId, $itemId);

    /**
     * Save
     *
     * @param int $cartId
     * @param int $vendorId
     * @param \Magento\GiftMessage\Api\Data\MessageInterface $giftMessage
     * @param int $itemId
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\State\InvalidTransitionException
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function vendorSave($cartId, $vendorId, \Magento\GiftMessage\Api\Data\MessageInterface $giftMessage, $itemId);
    
}