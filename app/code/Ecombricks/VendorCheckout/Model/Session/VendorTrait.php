<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Model\Session;

/**
 * Checkout session model vendor trait
 */
trait VendorTrait
{
    
    /**
     * Vendor Ids
     * 
     * @var int[]
     */
    protected $vendorIds;
    
    /**
     * After set vendor ID
     * 
     * @param int $vendorId
     * @return $this
     */
    public function afterSetVendorId($vendorId)
    {
        $this->_quote = null;
        $this->_order = null;
        return $this;
    }
    
    /**
     * Get vendor quote ID key
     * 
     * @param int $vendorId
     * @return string
     */
    protected function _getVendorQuoteIdKey($vendorId)
    {
        $websiteId = $this->_storeManager->getStore()->getWebsiteId();
        return 'quote_id_'.$websiteId.'_'.$vendorId;
    }
    
    /**
     * Get vendor quote ID key
     * 
     * @return string
     */
    protected function getVendorQuoteIdKey()
    {
        return $this->_getVendorQuoteIdKey($this->getVendorId());
    }
    
    /**
     * Set quote ID
     * 
     * @param int $quoteId
     * @return $this
     */
    public function vendorSetQuoteId($quoteId)
    {
        $this->storage->setData($this->getVendorQuoteIdKey(), $quoteId);
        return $this;
    }
    
    /**
     * Get quote ID
     * 
     * @return int
     */
    public function vendorGetQuoteId()
    {
        return $this->storage->getData($this->getVendorQuoteIdKey());
    }
    
    /**
     * Get active vendor IDs
     * 
     * @return array
     */
    public function getActiveVendorIds()
    {
        $vendorIds = [];
        foreach ($this->vendorManagement->getAvailableVendorIds() as $vendorId) {
            $quoteId = $this->storage->getData($this->_getVendorQuoteIdKey($vendorId));
            if ($quoteId) {
                $vendorIds[] = $vendorId;
            }
        }
        return $vendorIds;
    }
    
    /**
     * Get vendor IDs
     * 
     * @return array
     */
    public function getVendorIds()
    {
        if ($this->vendorIds !== null) {
            return $this->vendorIds;
        }
        $this->vendorIds = $this->getActiveVendorIds();
        if (!count($this->vendorIds) && ($this->_customerSession->isLoggedIn() || $this->_customer)) {
            $customerId = $this->_customer ? $this->_customer->getId() : $this->_customerSession->getCustomerId();
            $this->vendorIds = $this->quoteRepository->getVendorIdsForCustomer($customerId);
        }
        return $this->vendorIds;
    }
    
    /**
     * Load customer quotes
     * 
     * @return $this
     */
    public function loadCustomerQuotes()
    {
        $customerId = $this->_customerSession->getCustomerId();
        if (!$customerId) {
            return $this;
        }
        $initialVendorId = $this->getVendorId();
        $vendorIds = $this->getActiveVendorIds();
        $customerVendorIds = $this->quoteRepository->getVendorIdsForCustomer($customerId);
        if (count($customerVendorIds)) {
            $vendorIds = array_unique(array_merge($vendorIds, $customerVendorIds));
        }
        foreach ($vendorIds as $vendorId) {
            $this->setVendorId($vendorId);
            $this->loadCustomerQuote();
        }
        if ($initialVendorId) {
            $this->setVendorId($initialVendorId);
        }
        return $this;
    }
    
    /**
     * Call
     *
     * @param string $method
     * @param array $args
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function vendorCall($method, $args)
    {
        $methodPrefix = substr($method, 0, 3);
        $validMethodPrefixes = ['get', 'set', 'uns', 'has'];
        if (!in_array($methodPrefix, $validMethodPrefixes)) {
            throw new \InvalidArgumentException(
                sprintf('Invalid method %s::%s(%s)', get_class($this), $method, print_r($args, 1))
            );
        }
        $vendorId = $this->getVendorId();
        $vendorMethod = $method.(($vendorId) ? 'Vendor'.$vendorId : '');
        $return = call_user_func_array([ $this->storage, $vendorMethod ], $args);
        return $return === $this->storage ? $this : $return;
    }

}