<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Helper;

/**
 * Reorder helper plugin
 */
class Reorder
{
    
    /**
     * Around can reorder
     * 
     * @param \Magento\Sales\Helper\Reorder $subject
     * @param \Closure $proceed
     * @param int $orderId
     * @return bool
     */
    public function aroundCanReorder(
        \Magento\Sales\Helper\Reorder $subject,
        \Closure $proceed,
        $orderId
    )
    {
        $subject->vendorBeforeCanReorder($orderId);
        $canReorder = $proceed($orderId);
        $subject->vendorAfterCanReorder();
        return $canReorder;
    }
    
}