<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Model\Order\Email\Sender\ShipmentCommentSender;

/**
 * Shipment comment email sender vendor trait
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
     * Before send
     * 
     * @param \Magento\Sales\Model\Order\Shipment $shipment
     * @return $this
     */
    public function vendorBeforeSend(\Magento\Sales\Model\Order\Shipment $shipment)
    {
        $this->scopeConfigVendorId = $this->vendorScopeConfig->getVendorId();
        $this->vendorScopeConfig->setVendorId($shipment->getVendorId());
        return $this;
    }
    
    /**
     * After send
     * 
     * @return $this
     */
    public function vendorAfterSend()
    {
        $this->vendorScopeConfig->setVendorId($this->scopeConfigVendorId);
        return $this;
    }
    
}