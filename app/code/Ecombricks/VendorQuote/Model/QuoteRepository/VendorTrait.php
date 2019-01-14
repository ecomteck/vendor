<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Model\QuoteRepository;

/**
 * Quote repository model vendor trait
 */
trait VendorTrait
{
    
    /**
     * Vendor IDs by customer ID
     * 
     * @var array 
     */
    protected $vendorIdsByCustomerId = [];
    
    /**
     * Vendor IDs by quote ID
     * 
     * @var array
     */
    protected $vendorIdsByQuoteId = [];
    
    /**
     * After set vendor ID
     * 
     * @param int $vendorId
     * @return $this
     */
    public function afterSetVendorId($vendorId)
    {
        $this->quotesByCustomerId = [];
        return $this;
    }
    
    /**
     * Get vendor ID
     * 
     * @return int
     */
    public function getVendorId()
    {
        return ($this->vendorId) ? $this->vendorId : \Ecombricks\Vendor\Model\Vendor::DEFAULT_ID;
    }
    
    /**
     * Load quote
     *
     * @param string $loadMethod
     * @param string $loadField
     * @param int $identifier
     * @param int[] $sharedStoreIds
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @return \Magento\Quote\Model\Quote
     */
    protected function vendorLoadQuote($loadMethod, $loadField, $identifier, array $sharedStoreIds = [])
    {
        $vendorId = $this->getVendorId();
        $quote = $this->quoteFactory->create();
        if ($sharedStoreIds) {
            $quote->setSharedStoreIds($sharedStoreIds);
        }
        $quote->setStoreId($this->storeManager->getStore()->getId())->$loadMethod($vendorId, $identifier);
        if (!$quote->getId()) {
            throw \Magento\Framework\Exception\NoSuchEntityException::doubleField('vendorId', $vendorId, $loadField, $identifier);
        }
        return $quote;
    }
    
    /**
     * Get for customer
     * @param int $customerId
     * @param int[] $sharedStoreIds
     * @return \Magento\Quote\Api\Data\CartInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function vendorGetForCustomer($customerId, array $sharedStoreIds = [])
    {
        if (!isset($this->quotesByCustomerId[$customerId])) {
            $quote = $this->vendorLoadQuote('vendorLoadByCustomer', 'customerId', $customerId, $sharedStoreIds);
            $this->vendorLoadHandler->load($quote);
            $this->quotesById[$quote->getId()] = $quote;
            $this->quotesByCustomerId[$customerId] = $quote;
        }
        return $this->quotesByCustomerId[$customerId];
    }
    
    /**
     * Get vendor IDs by customer ID
     * 
     * @param int $customerId
     * @param int[] $sharedStoreIds
     * @return array
     */
    public function getVendorIdsForCustomer($customerId, array $sharedStoreIds = [])
    {
        if (!isset($this->vendorIdsByCustomerId[$customerId])) {
            $quote = $this->quoteFactory->create();
            if ($sharedStoreIds) {
                $quote->setSharedStoreIds($sharedStoreIds);
            }
            $this->vendorIdsByCustomerId[$customerId] = $quote->setStoreId($this->storeManager->getStore()->getId())
                ->getVendorIdsByCustomerId($customerId);
        }
        return $this->vendorIdsByCustomerId[$customerId];
    }
    
    /**
     * Get vendor ID by quote ID
     * 
     * @param int $quoteId
     * @return int
     */
    public function getVendorIdByQuoteId($quoteId)
    {
        if (!isset($this->vendorIdsByQuoteId[$quoteId])) {
            $vendorId = (int) $this->vendorQuoteResource->getVendorIdById($quoteId);
            $this->vendorIdsByQuoteId[$quoteId] = $vendorId;
        }
        return $this->vendorIdsByQuoteId[$quoteId];
    }
    
}