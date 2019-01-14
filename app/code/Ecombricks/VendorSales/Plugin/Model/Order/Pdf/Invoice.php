<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Model\Order\Pdf;

/**
 * Invoice PDF model plugin
 */
class Invoice
{
    
    /**
     * Around get PDF
     * 
     * @param \Magento\Sales\Model\Order\Pdf\Invoice $subject
     * @param \Closure $proceed
     * @param array|\Magento\Sales\Model\ResourceModel\Order\Invoice\Collection $invoices
     * @return \Zend_Pdf
     */
    public function aroundGetPdf(
        \Magento\Sales\Model\Order\Pdf\Invoice $subject,
        \Closure $proceed,
        $invoices = []
    )
    {
        return $subject->vendorGetPdf($invoices);
    }
    
}