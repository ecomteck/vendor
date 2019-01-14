<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Observer\Framework\Model\AbstractModel\BeforeDelete;

/**
 * Model before delete vendors observer trait
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
        $object = $this->getObject($observer);
        if (!$object) {
            return $this;
        }
        if (!$this->isTargetedType($object, $targetedTypes)) {
            return $this;
        }
        $object->vendorsBeforeDelete();
        return $this;
    }
    
}