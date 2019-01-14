<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Model\Locator;

/**
 * Registry vendor locator
 */
class RegistryLocator implements \Ecombricks\Vendor\Model\Locator\LocatorInterface
{
    
    /**
     * Registry
     * 
     * @var \Magento\Framework\Registry
     */
    protected $registry;
    
    /**
     * Vendor
     * 
     * @var \Ecombricks\Vendor\Model\Vendor
     */
    protected $vendor;
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\Registry $registry
     * @return void
     */
    public function __construct(\Magento\Framework\Registry $registry)
    {
        $this->registry = $registry;
    }
    
    /**
     * Get vendor
     * 
     * @return \Ecombricks\Vendor\Model\Vendor
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function getVendor()
    {
        if (null !== $this->vendor) {
            return $this->vendor;
        }
        $vendor = $this->registry->registry('vendor');
        if ($vendor) {
            return $this->vendor = $vendor;
        }
        throw new \Magento\Framework\Exception\NotFoundException(__('Vendor was not registered'));
    }
    
}