<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Plugin\Observer;

/**
 * Load customer quote observer plugin
 */
class LoadCustomerQuoteObserver
{
    
    /**
     * Around execute
     * 
     * @param \Magento\Checkout\Observer\LoadCustomerQuoteObserver $subject
     * @param \Closure $proceed
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function aroundExecute(
        \Magento\Checkout\Observer\LoadCustomerQuoteObserver $subject,
        \Closure $proceed,
        \Magento\Framework\Event\Observer $observer
    )
    {
        return $subject->vendorExecute($observer);
    }
    
}