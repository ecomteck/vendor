<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Framework\Plugin;

/**
 * Abstract factory plugin
 */
class AbstractFactoryPlugin extends \Ecombricks\Vendor\Framework\Plugin\AbstractPlugin
{
    
    /**
     * Create
     * 
     * @param \Closure $proceed
     * @param array $data
     * @return object
     */
    protected function create(\Closure $proceed, array $data = [])
    {
        $object = $proceed($data);
        $this->setVendorId($object);
        return $object;
    }
    
}