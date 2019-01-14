<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Model\Order\Payment;

/**
 * Payment transaction model plugin
 */
class Transaction extends \Ecombricks\Vendor\Framework\Plugin\AbstractPlugin
{
    
    /**
     * Around set order
     * 
     * @param \Magento\Sales\Model\Order\Payment\Transaction $subject
     * @param \Closure $proceed
     * @param \Magento\Sales\Model\Order|null|boolean $order
     * @return \Magento\Sales\Model\Order\Payment\Transaction
     */
    public function aroundSetOrder(
        \Magento\Sales\Model\Order\Payment\TransactionFactory $subject,
        \Closure $proceed,
        $order = null
    )
    {
        $result = $proceed($order);
        $this->copyVendorId($order, $subject);
        return $result;
    }
    
}