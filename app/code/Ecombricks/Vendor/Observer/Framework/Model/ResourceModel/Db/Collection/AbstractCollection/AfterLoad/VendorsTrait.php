<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Observer\Framework\Model\ResourceModel\Db\Collection\AbstractCollection\AfterLoad;

/**
 * Collection after load vendors observer trait
 */
trait VendorsTrait
{
    
    /**
     * Vendors execute
     * 
     * @param \Magento\Framework\Event\Observer $observer
     * @param array $targetedTypes
     * @return $this
     */
    protected function vendorsExecute(\Magento\Framework\Event\Observer $observer, $targetedTypes)
    {
        $collection = $this->getCollection($observer);
        if (!$collection) {
            return $this;
        }
        if (!$this->isTargetedType($collection, $targetedTypes)) {
            return $this;
        }
        $collection->vendorsAfterLoad();
        return $this;
    }
    
}