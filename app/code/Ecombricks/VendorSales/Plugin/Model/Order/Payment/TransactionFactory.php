<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Model\Order\Payment;

/**
 * Payment transaction model factory plugin
 */
class TransactionFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Sales\Model\Order\Payment\TransactionFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Sales\Model\Order\Payment\Transaction
     */
    public function aroundCreate(
        \Magento\Sales\Model\Order\Payment\TransactionFactory $subject,
        \Closure $proceed,
        array $data = []
    )
    {
        return $this
            ->setSubject($subject)
            ->create($proceed, $data);
    }
    
}