<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Controller\AbstractController\Invoice;

/**
 * Invoice abstract controller vendor trait
 */
trait VendorTrait
{
    
    /**
     * Get invoice
     * 
     * @param string|int $invoiceId
     * @return \Magento\Sales\Api\Data\InvoiceInterface|null
     */
    public function vendorGetInvoice($invoiceId)
    {
        if (empty($invoiceId)) {
            return null;
        }
        try {
            $invoice = $this->vendorInvoiceRepository->get($invoiceId);
        } catch (\Exception $exception) {
            return null;
        }
        return $invoice;
    }
    
    /**
     * Before dispatch
     * 
     * @param \Magento\Framework\App\RequestInterface $request
     * @return $this
     */
    public function vendorBeforeDispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $invoiceId = $request->getParam('invoice_id');
        $invoice = $this->vendorGetInvoice($invoiceId);
        if (!empty($invoice)) {
            $this->setVendorId($invoice->getVendorId());
        }
        $this->vendorAfterBeforeDispatch($request);
        return $this;
    }
    
}