<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Observer\Framework\Model\ResourceModel\Db\Collection;

/**
 * Abstract collection observer trait
 */
trait AbstractCollectionTrait
{
    
    /**
     * Get collection
     * 
     * @param \Magento\Framework\Event\Observer $observer
     * @return \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
     */
    protected function getCollection(\Magento\Framework\Event\Observer $observer)
    {
        $event = $observer->getEvent();
        if (!$event) {
            return null;
        }
        return $event->getCollection();
    }
    
    /**
     * Check if targeted type
     * 
     * @param \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection $collection
     * @param array $targetedTypes
     * @return bool
     */
    protected function isTargetedType(\Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection $collection, $targetedTypes)
    {
        $isClass = false;
        foreach ($targetedTypes as $class) {
            if ($collection instanceof $class) {
                $isClass = true;
                break;
            }
        }
        return $isClass;
    }
    
}