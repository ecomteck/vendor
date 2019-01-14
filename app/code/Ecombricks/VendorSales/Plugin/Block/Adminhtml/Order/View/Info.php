<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Block\Adminhtml\Order\View;

/**
 * View order info block plugin
 */
class Info
{
    
    /**
     * Around fetch view
     * 
     * @param \Magento\Sales\Block\Adminhtml\Order\View\Info $subject
     * @param \Closure $proceed
     * @param string $fileName
     * @return string
     */
    public function aroundFetchView(
        \Magento\Sales\Block\Adminhtml\Order\View\Info $subject,
        \Closure $proceed,
        $fileName
    )
    {
        $result = $proceed($fileName);
        return $subject->vendorAfterFetchView($result);
    }
    
}