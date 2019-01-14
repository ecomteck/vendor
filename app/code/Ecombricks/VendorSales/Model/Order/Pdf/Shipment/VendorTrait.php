<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Model\Order\Pdf\Shipment;

/**
 * Shipment PDF model vendor trait
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
     * @param \Magento\Sales\Model\Order\Shipment[] $shipments
     * @return \Zend_Pdf
     */
    public function vendorGetPdf($shipments = [])
    {
        $this->_beforeGetPdf();
        $this->_initRenderer('shipment');
        $pdf = new \Zend_Pdf();
        $this->_setPdf($pdf);
        $style = new \Zend_Pdf_Style();
        $this->_setFontBold($style, 10);
        foreach ($shipments as $shipment) {
            if ($shipment->getStoreId()) {
                $this->_localeResolver->emulate($shipment->getStoreId());
                $this->_storeManager->setCurrentStore($shipment->getStoreId());
            }
            $page = $this->newPage();
            $order = $shipment->getOrder();
            
            $this->scopeConfigVendorId = $this->_scopeConfig->getVendorId();
            $this->_scopeConfig->setVendorId($order->getVendorId());
            
            $this->insertLogo($page, $shipment->getStore());
            $this->insertAddress($page, $shipment->getStore());
            $this->insertOrder(
                $page,
                $shipment,
                $this->_scopeConfig->isSetFlag(
                    self::XML_PATH_SALES_PDF_SHIPMENT_PUT_ORDER_ID,
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
                    $order->getStoreId()
                )
            );
            $this->insertDocumentNumber($page, __('Packing Slip # ') . $shipment->getIncrementId());
            $this->insertOrderVendor($page, $order);
            $this->_drawHeader($page);
            foreach ($shipment->getAllItems() as $item) {
                if ($item->getOrderItem()->getParentItem()) {
                    continue;
                }
                $this->_drawItem($item, $page, $order);
                $page = end($pdf->pages);
            }
            
            $this->_scopeConfig->setVendorId($this->scopeConfigVendorId);
            
        }
        $this->_afterGetPdf();
        if ($shipment->getStoreId()) {
            $this->_localeResolver->revert();
        }
        return $pdf;
    }
    
}