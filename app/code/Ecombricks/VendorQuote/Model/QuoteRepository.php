<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Model;

/**
 * Quote repository model
 */
class QuoteRepository extends \Magento\Quote\Model\QuoteRepository 
    implements \Ecombricks\VendorQuote\Api\CartRepositoryInterface 
{
    
    /**
     * Get
     *
     * @param int $cartId
     * @param int $vendorId
     * @return \Magento\Quote\Api\Data\CartInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function vendorGet($cartId, $vendorId)
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->get($cartId);
    }

    /**
     * Get list
     *
     * @param int $vendorId
     * @param \Magento\Framework\Api\SearchCriteria $searchCriteria
     * @return \Magento\Quote\Api\Data\CartSearchResultsInterface
     */
    public function vendorGetList($vendorId, \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $this->setVendorId($vendorId);
        return $this->getList($searchCriteria);
    }

    /**
     * Get for customer
     * 
     * @param int $vendorId
     * @param int $customerId
     * @param int[] $sharedStoreIds
     * @return \Magento\Quote\Api\Data\CartInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function vendorGetForVendorAndCustomer($vendorId, $customerId, array $sharedStoreIds = [])
    {
        $this->setVendorId($vendorId);
        return $this->getForCustomer($customerId, $vendorId, $sharedStoreIds);
    }

    /**
     * Get active
     *
     * @param int $cartId
     * @param int $vendorId
     * @param int[] $sharedStoreIds
     * @return \Magento\Quote\Api\Data\CartInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function vendorGetActive($cartId, $vendorId, array $sharedStoreIds = [])
    {
        $this->setVendorId($vendorId);
        if (!$cartId) {
            $cartId = $this->vendorGetCartId($vendorId);
        }
        return $this->getActive($cartId, $sharedStoreIds);
    }

    /**
     * Get active for vendor and customer
     * 
     * @param int $vendorId
     * @param int $customerId
     * @param int[] $sharedStoreIds
     * @return \Magento\Quote\Api\Data\CartInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function vendorGetActiveForVendorAndCustomer($vendorId, $customerId, array $sharedStoreIds = [])
    {
        $this->setVendorId($vendorId);
        return $this->getActiveForCustomer($customerId, $sharedStoreIds);
    }

    /**
     * Save
     * 
     * @param int $vendorId
     * @param \Magento\Quote\Api\Data\CartInterface $quote
     * @return void
     */
    public function vendorSave($vendorId, \Magento\Quote\Api\Data\CartInterface $quote)
    {
        $this->setVendorId($vendorId);
        return $this->save($quote);
    }

    /**
     * Delete
     * 
     * @param int $vendorId
     * @param \Magento\Quote\Api\Data\CartInterface $quote
     * @return void
     */
    public function vendorDelete($vendorId, \Magento\Quote\Api\Data\CartInterface $quote)
    {
        $this->setVendorId($vendorId);
        return $this->delete($quote);
    }
    
}