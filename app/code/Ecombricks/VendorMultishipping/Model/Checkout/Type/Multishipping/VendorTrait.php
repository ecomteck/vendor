<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorMultishipping\Model\Checkout\Type\Multishipping;

/**
 * Multishipping checkout model vendor trait
 */
trait VendorTrait
{
    
    /**
     * Initialize
     */
    public function vendorInit()
    {
        $this->_init();
        return $this;
    }
    
    /**
     * After set vendor ID
     * 
     * @param int $vendorId
     * @return $this
     */
    public function afterSetVendorId($vendorId)
    {
        $this->vendorInit();
        return $this;
    }
    
}