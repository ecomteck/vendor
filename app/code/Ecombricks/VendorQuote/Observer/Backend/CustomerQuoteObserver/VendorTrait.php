<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Observer\Backend\CustomerQuoteObserver;

/**
 * Backend customer quote observer vendor trait
 */
trait VendorTrait
{
    
    /**
     * After get quote
     * 
     * @param \Magento\Quote\Model\Quote $quote
     * @return \Magento\Quote\Model\Quote
     */
    public function vendorAfterGetQuote($quote)
    {
        $vendorId = $this->getVendorId();
        if ($vendorId && ($vendorId != $quote->getVendorId())) {
            $quote->setVendorId($vendorId);
            $this->quoteRepository->save($quote);
        }
        return $quote;
    }
    
    /**
     * Execute
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function vendorExecute(\Magento\Framework\Event\Observer $observer)
    {
        $customer = $observer->getEvent()->getCustomerDataObject();
        try {
            $websites = $this->config->isWebsiteScope() ? [$this->storeManager->getWebsite($customer->getWebsiteId())] : $this->storeManager->getWebsites();
            $vendorIds = $this->quoteRepository->getVendorIdsForCustomer($customer->getId());
            foreach ($vendorIds as $vendorId) {
                $this->quoteRepository->setVendorId($vendorId);
                $quote = $this->quoteRepository->getForCustomer($customer->getId());
                if ($customer->getGroupId() !== $quote->getCustomerGroupId()) {
                    foreach ($websites as $website) {
                        $quote->setWebsite($website);
                        $quote->setCustomerGroupId($customer->getGroupId());
                        $quote->collectTotals();
                        $this->quoteRepository->save($quote);
                    }
                }
            }
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            
        }
    }
    
}