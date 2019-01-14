<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Model\Order;

/**
 * Credit memo model factory plugin
 */
class CreditmemoFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractPlugin
{
    
    /**
     * Around create by order
     * 
     * @param \Magento\Sales\Model\Order\CreditmemoFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Sales\Model\Order\Creditmemo
     */
    public function aroundCreateByOrder(
        \Magento\Sales\Model\Order\CreditmemoFactory $subject,
        \Closure $proceed,
        \Magento\Sales\Model\Order $order,
        array $data = []
    )
    {
        $result = $proceed($order, $data);
        $this->copyVendorId($order, $result);
        return $result;
    }
    
    /**
     * Around create by invoice
     * 
     * @param \Magento\Sales\Model\Order\CreditmemoFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Sales\Model\Order\Creditmemo
     */
    public function aroundCreateByInvoice(
        \Magento\Sales\Model\Order\CreditmemoFactory $subject,
        \Closure $proceed,
        \Magento\Sales\Model\Order\Invoice $invoice,
        array $data = []
    )
    {
        $result = $proceed($invoice, $data);
        $this->copyVendorId($invoice, $result);
        return $result;
    }
    
}