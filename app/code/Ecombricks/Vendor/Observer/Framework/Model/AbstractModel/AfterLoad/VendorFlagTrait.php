<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Observer\Framework\Model\AbstractModel\AfterLoad;

/**
 * Model after load vendor flag observer trait
 */
trait VendorFlagTrait
{
    
    /**
     * Vendor flag execute
     * 
     * @param \Magento\Framework\Event\Observer $observer
     * @param array $targetedTypes
     * @return $this
     */
    protected function vendorFlagExecute(\Magento\Framework\Event\Observer $observer, $targetedTypes)
    {
        $object = $this->getObject($observer);
        if (!$object) {
            return $this;
        }
        if (!$this->isTargetedType($object, $targetedTypes)) {
            return $this;
        }
        $object->vendorFlagAfterLoad();
        return $this;
    }
    
}