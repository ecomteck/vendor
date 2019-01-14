<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Model\Order\Email\Sender;

/**
 * Shipment comment email sender
 */
class ShipmentCommentSender
{
    
    /**
     * Around send
     * 
     * @param \Magento\Sales\Model\Order\Email\Sender\ShipmentCommentSender $subject
     * @param \Closure $proceed
     * @param \Magento\Sales\Model\Order\Shipment $shipment
     * @param bool $notify
     * @param string $comment
     * @return bool
     */
    public function aroundSend(
        \Magento\Sales\Model\Order\Email\Sender\ShipmentCommentSender $subject,
        \Closure $proceed,
        \Magento\Sales\Model\Order\Shipment $shipment,
        $notify = true,
        $comment = ''
    )
    {
        $subject->vendorBeforeSend($shipment);
        $result = $proceed($shipment, $notify, $comment);
        $subject->vendorAfterSend();
        return $result;
    }
    
}