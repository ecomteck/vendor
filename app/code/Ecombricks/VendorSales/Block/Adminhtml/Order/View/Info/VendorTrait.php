<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Block\Adminhtml\Order\View\Info;

/**
 * View order info block vendor trait
 */
trait VendorTrait
{
    
    /**
     * Get vendor HTML
     * 
     * @return string
     */
    public function getVendorHtml()
    {
        $order = $this->getOrder();
        if (empty($order)) {
            return null;
        }
        $vendor = $order->getVendor();
        if (empty($vendor)) {
            return null;
        }
        return sprintf('<tr><th>%s</th><td>%s</td></tr>', __('Order Vendor'), $this->escapeHtml($vendor->getName()));
    }
    
    /**
     * After fetch view
     * 
     * @param string $html
     * @return array
     */
    public function vendorAfterFetchView($html)
    {
        $position = strpos($html, 'order-information-table');
        if ($position === false) {
            return $html;
        }
        $htmlLength = mb_strlen($html);
        for ($index = $position; $index < $htmlLength; $index++) {
            $position++;
            if (mb_substr($html, $index, 1) == '>') {
                break;
            }
        }
        $vendorHtml = $this->getVendorHtml();
        if ($vendorHtml === null) {
            return $html;
        }
        return mb_substr($html, 0, $position).$vendorHtml.mb_substr($html, $position);
    }
    
}