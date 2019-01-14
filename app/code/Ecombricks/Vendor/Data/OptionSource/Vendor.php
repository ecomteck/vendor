<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Data\OptionSource;

/**
 * Vendor option source
 */
class Vendor implements \Magento\Framework\Data\OptionSourceInterface
{
    
    /**
     * Vendor management
     * 
     * @var \Ecombricks\Vendor\Model\VendorManagement
     */
    protected $vendorManagement;
    
    /**
     * Options
     * 
     * @var array
     */
    protected $options;
    
    /**
     * Constructor
     * 
     * @param \Ecombricks\Vendor\Model\VendorManagement $vendorManagement
     */
    public function __construct(\Ecombricks\Vendor\Model\VendorManagement $vendorManagement)
    {
        $this->vendorManagement = $vendorManagement;
    }
    
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        if ($this->options !== null) {
            return $this->options;
        }
        $this->options = $this->vendorManagement->getAvailableVendorOptions(false);
        return $this->options;
    }
    
}