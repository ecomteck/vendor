<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Model\Order\Email\Sender;

/**
 * Invoice comment email sender
 */
class InvoiceCommentSender
{
    
    /**
     * Around send
     * 
     * @param \Magento\Sales\Model\Order\Email\Sender\InvoiceCommentSender $subject
     * @param \Closure $proceed
     * @param \Magento\Sales\Model\Order\Invoice $invoice
     * @param bool $notify
     * @param string $comment
     * @return bool
     */
    public function aroundSend(
        \Magento\Sales\Model\Order\Email\Sender\InvoiceCommentSender $subject,
        \Closure $proceed,
        \Magento\Sales\Model\Order\Invoice $invoice,
        $notify = true,
        $comment = ''
    )
    {
        $subject->vendorBeforeSend($invoice);
        $result = $proceed($invoice, $notify, $comment);
        $subject->vendorAfterSend();
        return $result;
    }
    
}