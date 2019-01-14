<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorQuote\Plugin\Observer\Backend;

/**
 * Backend customer quote observer plugin
 */
class CustomerQuoteObserver
{
    
    /**
     * Around apply log to collection
     * 
     * @param \Magento\Quote\Observer\Backend\CustomerQuoteObserver $subject
     * @param \Closure $proceed
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function aroundExecute(
        \Magento\Quote\Observer\Backend\CustomerQuoteObserver $subject,
        \Closure $proceed,
        \Magento\Framework\Event\Observer $observer
    )
    {
        return $subject->vendorExecute($observer);
    }
    
}