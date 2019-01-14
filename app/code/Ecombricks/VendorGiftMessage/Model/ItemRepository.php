<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorGiftMessage\Model;

/**
 * Gift message item repository model
 */
class ItemRepository extends \Magento\GiftMessage\Model\ItemRepository 
    implements \Ecombricks\VendorGiftMessage\Api\ItemRepositoryInterface 
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
    public function vendorGet($cartId, $vendorId, $itemId)
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->get($cartId, $itemId);
    }
    
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
    public function vendorSave($cartId, $vendorId, \Magento\GiftMessage\Api\Data\MessageInterface $giftMessage, $itemId)
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->save($cartId, $giftMessage, $itemId);
    }
    
}