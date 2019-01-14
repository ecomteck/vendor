<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Observer\Framework\Model;

/**
 * Abstract model observer trait
 */
trait AbstractModelTrait
{
    
    /**
     * Get object
     * 
     * @param \Magento\Framework\Event\Observer $observer
     * @return \Magento\Framework\Model\AbstractModel
     */
    protected function getObject(\Magento\Framework\Event\Observer $observer)
    {
        $event = $observer->getEvent();
        if (!$event) {
            return null;
        }
        return $event->getObject();
    }
    
    /**
     * Prepare class
     * 
     * @param string $class
     */
    protected function prepareClass($class)
    {
        if (substr($class, 0, 1) !== '\\') {
            return '\\'.$class;
        }
        return $class;
    }
    
    /**
     * Check if targeted type
     * 
     * @param \Magento\Framework\Model\AbstractModel $object
     * @param array $targetedTypes
     * @return bool
     */
    protected function isTargetedType(\Magento\Framework\Model\AbstractModel $object, $targetedTypes)
    {
        $isClass = false;
        foreach ($targetedTypes as $class) {
            $class = $this->prepareClass($class);
            if ($object instanceof $class) {
                $isClass = true;
                break;
            }
        }
        return $isClass;
    }
    
}