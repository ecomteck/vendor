<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorReports\Plugin\Model\ResourceModel\Product;

/**
 * Report product collection factory plugin
 */
class CollectionFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Reports\Model\ResourceModel\Product\CollectionFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Reports\Model\ResourceModel\Product\Collection
     */
    public function aroundCreate(
        \Magento\Reports\Model\ResourceModel\Product\CollectionFactory $subject,
        \Closure $proceed,
        array $data = []
    )
    {
        return $this
            ->setSubject($subject)
            ->create($proceed, $data);
    }
    
}