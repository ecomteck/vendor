<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Observer\Framework\Model\ResourceModel\Db\Collection\AbstractCollection\BeforeLoad;

/**
 * Collection before load vendor observer trait
 */
trait VendorTrait
{
    
    /**
     * Vendor execute
     * 
     * @param \Magento\Framework\Event\Observer $observer
     * @param array $targetedTypes
     * @return $this
     */
    protected function vendorExecute(\Magento\Framework\Event\Observer $observer, $targetedTypes)
    {
        $collection = $this->getCollection($observer);
        if (!$collection) {
            return $this;
        }
        if (!$this->isTargetedType($collection, $targetedTypes)) {
            return $this;
        }
        $collection->vendorBeforeLoad();
        return $this;
    }
    
}