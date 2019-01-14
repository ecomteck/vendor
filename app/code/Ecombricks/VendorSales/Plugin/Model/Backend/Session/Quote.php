<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Model\Backend\Session;

/**
 * Backend quote session model plugin
 */
class Quote
{
    
    /**
     * Around call
     * 
     * @param \Magento\Backend\Model\Session\Quote $subject
     * @param \Closure $proceed
     * @param string $method
     * @param array $args
     * @return mixed
     */
    public function around__call(
        \Magento\Backend\Model\Session\Quote $subject,
        \Closure $proceed,
        $method,
        $args
    )
    {
        return $subject->vendorCall($method, $args);
    }
    
}