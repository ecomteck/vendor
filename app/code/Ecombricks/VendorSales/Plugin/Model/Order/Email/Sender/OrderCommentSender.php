<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Model\Order\Email\Sender;

/**
 * Order comment email sender
 */
class OrderCommentSender
{
    
    /**
     * Around send
     * 
     * @param \Magento\Sales\Model\Order\Email\Sender\OrderCommentSender $subject
     * @param \Closure $proceed
     * @param \Magento\Sales\Model\Order $order
     * @param bool $notify
     * @param string $comment
     * @return bool
     */
    public function aroundSend(
        \Magento\Sales\Model\Order\Email\Sender\OrderCommentSender $subject,
        \Closure $proceed,
        \Magento\Sales\Model\Order $order,
        $notify = true,
        $comment = ''
    )
    {
        $subject->vendorBeforeSend($order);
        $result = $proceed($order, $notify, $comment);
        $subject->vendorAfterSend();
        return $result;
    }
    
}