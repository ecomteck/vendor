<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Api;

/**
 * Quote cart item repository interface
 */
interface CartItemRepositoryInterface extends \Magento\Quote\Api\CartItemRepositoryInterface
{
    
    /**
     * Get list
     *
     * @param int $cartId
     * @param int $vendorId
     * @return \Magento\Quote\Api\Data\CartItemInterface[]
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function vendorGetList($cartId, $vendorId);
    
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
    public function vendorSave($vendorId, \Magento\Quote\Api\Data\CartItemInterface $cartItem);
    
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
    public function vendorDeleteById($cartId, $vendorId, $itemId);
    
}