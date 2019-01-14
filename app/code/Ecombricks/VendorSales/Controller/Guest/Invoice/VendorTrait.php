<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Controller\Guest\Invoice;

/**
 * Guest invoice controller vendor trait
 */
trait VendorTrait
{
    
    /**
     * Before dispatch
     * 
     * @param \Magento\Framework\App\RequestInterface $request
     * @return $this
     */
    public function vendorBeforeDispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $invoice = $this->vendorGetInvoice($request->getParam('invoice_id'));
        if (!empty($invoice)) {
            $order = $invoice->getOrder();
        }
        if (empty($order)) {
            $order = $this->vendorGetOrder($this->vendorGetOrderIncrementId($request));
        }
        if (!empty($order)) {
            $this->setVendorId($order->getVendorId());
        }
        $this->vendorAfterBeforeDispatch($request);
        return $this;
    }
    
}