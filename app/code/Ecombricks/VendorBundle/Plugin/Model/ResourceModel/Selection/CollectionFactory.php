<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorBundle\Plugin\Model\ResourceModel\Selection;

/**
 * Bundle selection collection factory plugin
 */
class CollectionFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Bundle\Model\ResourceModel\Selection\CollectionFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Bundle\Model\ResourceModel\Selection\Collection
     */
    public function aroundCreate(
        \Magento\Bundle\Model\ResourceModel\Selection\CollectionFactory $subject,
        \Closure $proceed,
        array $data = []
    )
    {
        return $this
            ->setSubject($subject)
            ->create($proceed, $data);
    }
    
}