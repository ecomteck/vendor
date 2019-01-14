<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Model\Order\Email\Sender;

/**
 * Creditmemo email sender
 */
class CreditmemoSender
{
    
    /**
     * Around send
     * 
     * @param \Magento\Sales\Model\Order\Email\Sender\CreditmemoSender $subject
     * @param \Closure $proceed
     * @param \Magento\Sales\Model\Order\Creditmemo $creditmemo
     * @param bool $forceSyncMode
     * @return bool
     */
    public function aroundSend(
        \Magento\Sales\Model\Order\Email\Sender\CreditmemoSender $subject,
        \Closure $proceed,
        \Magento\Sales\Model\Order\Creditmemo $creditmemo,
        $forceSyncMode = false
    )
    {
        $subject->vendorBeforeSend($creditmemo);
        $result = $proceed($creditmemo, $forceSyncMode);
        $subject->vendorAfterSend();
        return $result;
    }
    
}