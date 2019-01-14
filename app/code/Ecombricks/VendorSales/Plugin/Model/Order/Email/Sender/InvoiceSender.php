<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Model\Order\Email\Sender;

/**
 * Invoice email sender
 */
class InvoiceSender
{
    
    /**
     * Around send
     * 
     * @param \Magento\Sales\Model\Order\Email\Sender\InvoiceSender $subject
     * @param \Closure $proceed
     * @param \Magento\Sales\Model\Order\Invoice $invoice
     * @param bool $forceSyncMode
     * @return bool
     */
    public function aroundSend(
        \Magento\Sales\Model\Order\Email\Sender\InvoiceSender $subject,
        \Closure $proceed,
        \Magento\Sales\Model\Order\Invoice $invoice,
        $forceSyncMode = false
    )
    {
        $subject->vendorBeforeSend($invoice);
        $result = $proceed($invoice, $forceSyncMode);
        $subject->vendorAfterSend();
        return $result;
    }
    
}