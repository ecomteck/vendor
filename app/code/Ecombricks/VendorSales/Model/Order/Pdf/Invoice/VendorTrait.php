<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Model\Order\Pdf\Invoice;

/**
 * Invoice PDF model vendor trait
 */
trait VendorTrait
{
    
    /**
     * Scope config vendor ID
     * 
     * @var int 
     */
    protected $scopeConfigVendorId;
    
    /**
     * Get PDF
     * 
     * @param array|\Magento\Sales\Model\ResourceModel\Order\Invoice\Collection $invoices
     * @return \Zend_Pdf
     */
    public function vendorGetPdf($invoices = [])
    {
        $this->_beforeGetPdf();
        $this->_initRenderer('invoice');
        $pdf = new \Zend_Pdf();
        $this->_setPdf($pdf);
        $style = new \Zend_Pdf_Style();
        $this->_setFontBold($style, 10);
        foreach ($invoices as $invoice) {
            if ($invoice->getStoreId()) {
                $this->_localeResolver->emulate($invoice->getStoreId());
                $this->_storeManager->setCurrentStore($invoice->getStoreId());
            }
            $page = $this->newPage();
            $order = $invoice->getOrder();
            
            $this->scopeConfigVendorId = $this->_scopeConfig->getVendorId();
            $this->_scopeConfig->setVendorId($order->getVendorId());
            
            $this->insertLogo($page, $invoice->getStore());
            $this->insertAddress($page, $invoice->getStore());
            $this->insertOrder(
                $page,
                $order,
                $this->_scopeConfig->isSetFlag(self::XML_PATH_SALES_PDF_INVOICE_PUT_ORDER_ID, \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $order->getStoreId())
            );
            $this->insertDocumentNumber($page, __('Invoice # ') . $invoice->getIncrementId());
            $this->insertOrderVendor($page, $order);
            $this->_drawHeader($page);
            foreach ($invoice->getAllItems() as $item) {
                if ($item->getOrderItem()->getParentItem()) {
                    continue;
                }
                $this->_drawItem($item, $page, $order);
                $page = end($pdf->pages);
            }
            $this->insertTotals($page, $invoice);
            
            $this->_scopeConfig->setVendorId($this->scopeConfigVendorId);
            
            if ($invoice->getStoreId()) {
                $this->_localeResolver->revert();
            }
        }
        $this->_afterGetPdf();
        return $pdf;
    }
    
}