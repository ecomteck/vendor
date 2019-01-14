<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Plugin\Model\ResourceModel\Order\Invoice;

/**
 * Invoice collection factory plugin
 */
class CollectionFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Sales\Model\ResourceModel\Order\Invoice\CollectionFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Sales\Model\ResourceModel\Order\Invoice\Collection
     */
    public function aroundCreate(
        \Magento\Sales\Model\ResourceModel\Order\Invoice\CollectionFactory $subject,
        \Closure $proceed,
        array $data = []
    )
    {
        return $this
            ->setSubject($subject)
            ->create($proceed, $data);
    }
    
}