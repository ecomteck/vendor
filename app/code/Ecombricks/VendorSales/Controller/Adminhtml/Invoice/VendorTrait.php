<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Controller\Adminhtml\Invoice;

/**
 * Invoice controller vendor trait
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
     * Get order
     * 
     * @param string|int $orderId
     * @return \Magento\Sales\Api\Data\OrderInterface|null
     */
    public function vendorGetOrder($orderId)
    {
        if (empty($orderId)) {
            return null;
        }
        try {
            $order = $this->vendorOrderRepository->get($orderId);
        } catch (\Exception $exception) {
            return null;
        }
        return $order;
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
        if (empty($invoiceId)) {
            $invoiceId = $request->getParam('id');
        }
        $orderId = $request->getParam('order_id');
        if (!empty($invoiceId)) {
            $invoice = $this->vendorGetInvoice($invoiceId);
            if ($invoice) {
                $this->setVendorId($invoice->getVendorId());
            }
        } else if (!empty($orderId)) {
            $order = $this->vendorGetOrder($orderId);
            if ($order) {
                $this->setVendorId($order->getVendorId());
            }
        }
        $this->vendorAfterBeforeDispatch($request);
        return $this;
    }
    
}