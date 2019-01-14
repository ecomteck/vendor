<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Model\Order\Pdf;

/**
 * Creditmemo PDF model plugin
 */
class Creditmemo
{
    
    /**
     * Around get PDF
     * 
     * @param \Magento\Sales\Model\Order\Pdf\Creditmemo $subject
     * @param \Closure $proceed
     * @param array $creditmemos
     * @return \Zend_Pdf
     */
    public function aroundGetPdf(
        \Magento\Sales\Model\Order\Pdf\Creditmemo $subject,
        \Closure $proceed,
        $creditmemos = []
    )
    {
        return $subject->vendorGetPdf($creditmemos);
    }
    
}