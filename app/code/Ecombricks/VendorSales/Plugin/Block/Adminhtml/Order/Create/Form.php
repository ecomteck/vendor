<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Block\Adminhtml\Order\Create;

/**
 * Create order form block plugin
 */
class Form
{
    
    /**
     * Around get order data JSON
     * 
     * @param \Magento\Sales\Block\Adminhtml\Order\Create\Form $subject
     * @param \Closure $proceed
     * @return string
     */
    public function aroundGetOrderDataJson(
        \Magento\Sales\Block\Adminhtml\Order\Create\Form $subject,
        \Closure $proceed
    )
    {
        return $subject->vendorAfterGetOrderDataJson($proceed());
    }
    
}