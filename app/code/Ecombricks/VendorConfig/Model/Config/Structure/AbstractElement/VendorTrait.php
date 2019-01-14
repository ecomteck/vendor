<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorConfig\Model\Config\Structure\AbstractElement;

/**
 * Config structure abstract element model vendor trait
 */
trait VendorTrait
{
    
    /**
     * Check if enabled for vendor
     *
     * @return bool
     */
    public function isEnabledForVendor()
    {
        return isset($this->_data['enabledForVendor']) ? ($this->_data['enabledForVendor'] === 'true') : false;
    }
    
    /**
     * Check if enabled for vendor only
     *
     * @return bool
     */
    public function isEnabledForVendorOnly()
    {
        return isset($this->_data['enabledForVendorOnly']) ? ($this->_data['enabledForVendorOnly'] === 'true') : false;
    }
    
}