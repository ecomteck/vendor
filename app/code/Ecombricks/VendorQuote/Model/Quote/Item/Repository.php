<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Model\Quote\Item;

/**
 * Quote item repository model
 */
class Repository extends \Magento\Quote\Model\Quote\Item\Repository 
    implements \Ecombricks\VendorQuote\Api\CartItemRepositoryInterface 
{
    
    /**
     * Get list
     *
     * @param int $cartId
     * @param int $vendorId
     * @return \Magento\Quote\Api\Data\CartItemInterface[]
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

    /**
     * Save
     * 
     * @param int $vendorId
     * @param \Magento\Quote\Api\Data\CartItemInterface $cartItem
     * @return \Magento\Quote\Api\Data\CartItemInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @throws \Magento\Framework\Exception\InputException
     */
    public function vendorSave($vendorId, \Magento\Quote\Api\Data\CartItemInterface $cartItem)
    {
        $this->setVendorId($vendorId);
        $cartId = $this->vendorGetCartId($vendorId);
        if ($cartItem->getQuoteId() !== $cartId) {
            throw \Magento\Framework\Exception\NoSuchEntityException::doubleField('quote_id', $cartItem->getQuoteId(), 'vendor_id', $vendorId);
        }
        return $this->save($cartItem);
    }
    
    /**
     * Delete by ID
     *
     * @param int $cartId
     * @param int $vendorId
     * @param int $itemId
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function vendorDeleteById($cartId, $vendorId, $itemId)
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->deleteById($cartId, $itemId);
    }
    
}