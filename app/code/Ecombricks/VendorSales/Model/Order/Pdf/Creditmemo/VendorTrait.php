<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Model\Order\Pdf\Creditmemo;

/**
 * Creditmemo PDF model vendor trait
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
     * @param array $creditmemos
     * @return \Zend_Pdf
     */
    public function vendorGetPdf($creditmemos = [])
    {
        $this->_beforeGetPdf();
        $this->_initRenderer('creditmemo');
        $pdf = new \Zend_Pdf();
        $this->_setPdf($pdf);
        $style = new \Zend_Pdf_Style();
        $this->_setFontBold($style, 10);
        foreach ($creditmemos as $creditmemo) {
            if ($creditmemo->getStoreId()) {
                $this->_localeResolver->emulate($creditmemo->getStoreId());
                $this->_storeManager->setCurrentStore($creditmemo->getStoreId());
            }
            $page = $this->newPage();
            $order = $creditmemo->getOrder();
            
            $this->scopeConfigVendorId = $this->_scopeConfig->getVendorId();
            $this->_scopeConfig->setVendorId($order->getVendorId());
            
            $this->insertLogo($page, $creditmemo->getStore());
            $this->insertAddress($page, $creditmemo->getStore());
            $this->insertOrder(
                $page,
                $order,
                $this->_scopeConfig->isSetFlag(self::XML_PATH_SALES_PDF_CREDITMEMO_PUT_ORDER_ID, \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $order->getStoreId())
            );
            $this->insertDocumentNumber($page, __('Credit Memo # ') . $creditmemo->getIncrementId());
            $this->insertOrderVendor($page, $order);
            $this->_drawHeader($page);
            foreach ($creditmemo->getAllItems() as $item) {
                if ($item->getOrderItem()->getParentItem()) {
                    continue;
                }
                $this->_drawItem($item, $page, $order);
                $page = end($pdf->pages);
            }
            $this->insertTotals($page, $creditmemo);
            
            $this->_scopeConfig->setVendorId($this->scopeConfigVendorId);
            
        }
        $this->_afterGetPdf();
        if ($creditmemo->getStoreId()) {
            $this->_localeResolver->revert();
        }
        return $pdf;
    }
    
}