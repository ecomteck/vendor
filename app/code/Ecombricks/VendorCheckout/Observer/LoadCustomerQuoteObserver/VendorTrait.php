<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Observer\LoadCustomerQuoteObserver;

/**
 * Load customer quote observer vendor trait
 */
trait VendorTrait
{
    
    /**
     * Execute
     * 
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function vendorExecute(\Magento\Framework\Event\Observer $observer)
    {
        try {
            $this->checkoutSession->loadCustomerQuotes();
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('Load customer quotes error'));
        }
    }
    
}