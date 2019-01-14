<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Model\Order\Pdf;

/**
 * Shipment PDF model plugin
 */
class Shipment
{
    
    /**
     * Around get PDF
     * 
     * @param \Magento\Sales\Model\Order\Pdf\Shipment $subject
     * @param \Closure $proceed
     * @param \Magento\Sales\Model\Order\Shipment[] $shipments
     * @return \Zend_Pdf
     */
    public function aroundGetPdf(
        \Magento\Sales\Model\Order\Pdf\Shipment $subject,
        \Closure $proceed,
        $shipments = []
    )
    {
        return $subject->vendorGetPdf($shipments);
    }
    
}