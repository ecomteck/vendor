<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorReports\Plugin\Model\ResourceModel\Order;

/**
 * Report order collection factory plugin
 */
class CollectionFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Reports\Model\ResourceModel\Order\CollectionFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Reports\Model\ResourceModel\Order\Collection
     */
    public function aroundCreate(
        \Magento\Reports\Model\ResourceModel\Order\CollectionFactory $subject,
        \Closure $proceed,
        array $data = []
    )
    {
        return $this
            ->setSubject($subject)
            ->create($proceed, $data);
    }
    
}