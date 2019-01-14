<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Plugin\Model;

/**
 * Checkout session model plugin
 */
class Session
{
    
    /**
     * Around set quote ID
     * 
     * @param \Magento\Checkout\Model\Session $subject
     * @param \Closure $proceed
     * @param int $quoteId
     * @return \Magento\Checkout\Model\Session
     */
    public function aroundSetQuoteId(
        \Magento\Checkout\Model\Session $subject,
        \Closure $proceed,
        $quoteId
    )
    {
        $subject->vendorSetQuoteId($quoteId);
        return $subject;
    }
    
    /**
     * Around set quote ID
     * 
     * @param \Magento\Checkout\Model\Session $subject
     * @param \Closure $proceed
     * @param int $quoteId
     * @return \Magento\Checkout\Model\Session
     */
    public function aroundGetQuoteId(
        \Magento\Checkout\Model\Session $subject,
        \Closure $proceed
    )
    {
        return $subject->vendorGetQuoteId();
    }
    
    /**
     * Around call
     * 
     * @param \Magento\Checkout\Model\Session $subject
     * @param \Closure $proceed
     * @param string $method
     * @param array $args
     * @return mixed
     */
    public function around__call(
        \Magento\Checkout\Model\Session $subject,
        \Closure $proceed,
        $method,
        $args
    )
    {
        return $subject->vendorCall($method, $args);
    }
    
}