<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Framework\Plugin;

/**
 * Abstract plugin
 */
class AbstractPlugin extends \Ecombricks\Framework\Plugin\AbstractPlugin
{
    
    /**
     * Copy vendor ID
     * 
     * @param object $from
     * @param object $to
     * @param bool $copyIfEmpty
     */
    protected function copyVendorId($from, $to, $copyIfEmpty = true)
    {
        if (
            empty($from) || empty($to) || 
            !is_object($from) || !is_object($to) || 
            !method_exists($from, 'getVendorId') || !method_exists($to, 'setVendorId')
        ) {
            return $this;
        }
        $vendorId = $from->getVendorId();
        if (empty($vendorId) && !$copyIfEmpty) {
            return $this;
        }
        $to->setVendorId($vendorId);
        return $this;
    }
    
    /**
     * Set vendor ID
     * 
     * @param object $object
     * @param bool $setIfEmpty
     * @return $this
     */
    protected function setVendorId($object, $setIfEmpty = true)
    {
        $this->copyVendorId($this->getSubject(), $object, $setIfEmpty);
        return $this;
    }
    
}