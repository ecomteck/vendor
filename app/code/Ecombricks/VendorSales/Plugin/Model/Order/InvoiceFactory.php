<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Model\Order;

/**
 * Invoice model factory plugin
 */
class InvoiceFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Sales\Model\Order\InvoiceFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Sales\Model\Order\Invoice
     */
    public function aroundCreate(
        \Magento\Sales\Model\Order\InvoiceFactory $subject,
        \Closure $proceed,
        array $data = []
    )
    {
        return $this
            ->setSubject($subject)
            ->create($proceed, $data);
    }
    
}