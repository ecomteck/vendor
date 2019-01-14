<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Observer\Framework\Model\AbstractModel\BeforeSave;

/**
 * Model before save vendor observer trait
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
        $object = $this->getObject($observer);
        if (!$object) {
            return $this;
        }
        if (!$this->isTargetedType($object, $targetedTypes)) {
            return $this;
        }
        $object->vendorBeforeSave();
        return $this;
    }
    
}