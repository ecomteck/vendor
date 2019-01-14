<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Framework\View\Layout\GeneratorPool;

/**
 * Layout generator pool vendor trait
 */
trait VendorTrait
{
    
    /**
     * After set vendor ID
     * 
     * @param int $vendorId
     * @return $this
     */
    public function afterSetVendorId($vendorId)
    {
        if (empty($this->generators)) {
            return $this;
        }
        foreach ($this->generators as $generator) {
            if ($this->canObjectAcceptVendorId($generator)) {
                $this->copyVendorId($generator, $vendorId);
            }
        }
        return $this;
    }
    
}