<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Model\Order\Email\Sender;

/**
 * Creditmemo comment email sender
 */
class CreditmemoCommentSender
{
    
    /**
     * Around send
     * 
     * @param \Magento\Sales\Model\Order\Email\Sender\CreditmemoCommentSender $subject
     * @param \Closure $proceed
     * @param \Magento\Sales\Model\Order\Creditmemo $creditmemo
     * @param bool $notify
     * @param string $comment
     * @return bool
     */
    public function aroundSend(
        \Magento\Sales\Model\Order\Email\Sender\CreditmemoCommentSender $subject,
        \Closure $proceed,
        \Magento\Sales\Model\Order\Creditmemo $creditmemo,
        $notify = true,
        $comment = ''
    )
    {
        $subject->vendorBeforeSend($creditmemo);
        $result = $proceed($creditmemo, $notify, $comment);
        $subject->vendorAfterSend();
        return $result;
    }
    
}