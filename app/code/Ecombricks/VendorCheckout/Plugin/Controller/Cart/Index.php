<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Plugin\Controller\Cart;

/**
 * Cart index controller plugin
 */
class Index
{
    
    /**
     * Around execute
     * 
     * @param \Magento\Checkout\Controller\Cart\Index $subject
     * @param \Closure $proceed
     * @return \Magento\Framework\View\Result\Page
     */
    public function aroundExecute(
        \Magento\Checkout\Controller\Cart\Index $subject,
        \Closure $proceed
    )
    {
        
        $result = $proceed();
        $subject->vendorAfterExecute($result);
        return $result;
    }
    
}