<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Api;

/**
 * Quote cart repository interface
 */
interface CartRepositoryInterface extends \Magento\Quote\Api\CartRepositoryInterface
{
    
    /**
     * Get
     *
     * @param int $cartId
     * @param int $vendorId
     * @return \Magento\Quote\Api\Data\CartInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function vendorGet($cartId, $vendorId);
    
    /**
     * Get list
     *
     * @param int $vendorId
     * @param \Magento\Framework\Api\SearchCriteria $searchCriteria
     * @return \Magento\Quote\Api\Data\CartSearchResultsInterface
     */
    public function vendorGetList($vendorId, \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Get for vendor and customer
     * 
     * @param int $vendorId
     * @param int $customerId
     * @param int[] $sharedStoreIds
     * @return \Magento\Quote\Api\Data\CartInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function vendorGetForVendorAndCustomer($vendorId, $customerId, array $sharedStoreIds = []);

    /**
     * Get active
     *
     * @param int $cartId
     * @param int $vendorId
     * @param int[] $sharedStoreIds
     * @return \Magento\Quote\Api\Data\CartInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function vendorGetActive($cartId, $vendorId, array $sharedStoreIds = []);
    
    /**
     * Get active for vendor and customer
     * 
     * @param int $vendorId
     * @param int $customerId
     * @param int[] $sharedStoreIds
     * @return \Magento\Quote\Api\Data\CartInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function vendorGetActiveForVendorAndCustomer($vendorId, $customerId, array $sharedStoreIds = []);
    
    /**
     * Save
     * 
     * @param int $vendorId
     * @param \Magento\Quote\Api\Data\CartInterface $quote
     * @return void
     */
    public function vendorSave($vendorId, \Magento\Quote\Api\Data\CartInterface $quote);

    /**
     * Delete
     * 
     * @param int $vendorId
     * @param \Magento\Quote\Api\Data\CartInterface $quote
     * @return void
     */
    public function vendorDelete($vendorId, \Magento\Quote\Api\Data\CartInterface $quote);
    
}