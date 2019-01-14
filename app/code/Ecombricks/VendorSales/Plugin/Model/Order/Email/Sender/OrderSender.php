<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Model\Order\Email\Sender;

/**
 * Order email sender
 */
class OrderSender
{
    
    /**
     * Around send
     * 
     * @param \Magento\Sales\Model\Order\Email\Sender\OrderSender $subject
     * @param \Closure $proceed
     * @param \Magento\Sales\Model\Order $order
     * @param bool $forceSyncMode
     * @return bool
     */
    public function aroundSend(
        \Magento\Sales\Model\Order\Email\Sender\OrderSender $subject,
        \Closure $proceed,
        \Magento\Sales\Model\Order $order,
        $forceSyncMode = false
    )
    {
        $subject->vendorBeforeSend($order);
        $result = $proceed($order, $forceSyncMode);
        $subject->vendorAfterSend();
        return $result;
    }
    
}