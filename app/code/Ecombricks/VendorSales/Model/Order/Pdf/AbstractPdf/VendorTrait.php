<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Model\Order\Pdf\AbstractPdf;

/**
 * Sales abstract PDF model vendor trait
 */
trait VendorTrait
{
    
    /**
     * Insert order vendor
     *
     * @param \Zend_Pdf_Page &$page
     * @param \Magento\Sales\Model\Order $order
     * @return $this
     */
    public function insertOrderVendor(&$page, $order)
    {
        $vendor = $order->getVendor();
        if (!$vendor) {
            return $this;
        }
        $page->setFillColor(new \Zend_Pdf_Color_GrayScale(1));
        $this->_setFontRegular($page, 10);
        $top = $this->y;
        $docHeader = $this->getDocHeaderCoordinates();
        $page->drawText(__('Vendor: %1', $vendor->getName()), 285, $docHeader[1] - 15, 'UTF-8');
        $this->y = $top;
        return $this;
    }
    
}