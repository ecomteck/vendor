<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Model\Order\Email\Sender;

/**
 * Shipment email sender
 */
class ShipmentSender
{
    
    /**
     * Around send
     * 
     * @param \Magento\Sales\Model\Order\Email\Sender\ShipmentSender $subject
     * @param \Closure $proceed
     * @param \Magento\Sales\Model\Order\Shipment $shipment
     * @param bool $forceSyncMode
     * @return bool
     */
    public function aroundSend(
        \Magento\Sales\Model\Order\Email\Sender\ShipmentSender $subject,
        \Closure $proceed,
        \Magento\Sales\Model\Order\Shipment $shipment,
        $forceSyncMode = false
    )
    {
        $subject->vendorBeforeSend($shipment);
        $result = $proceed($shipment, $forceSyncMode);
        $subject->vendorAfterSend();
        return $result;
    }
    
}