<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Framework\View\Layout;

/**
 * Layout vendor trait
 */
trait VendorTrait
{
    
    /**
     * Apply children vendor ID
     * 
     * @param string $name
     * @return $this
     */
    public function applyChildrenVendorId($name)
    {
        $childNames = $this->getChildNames($name);
        if (!count($childNames)) {
            return $this;
        }
        foreach ($childNames as $childName) {
            $child = $this->getBlock($childName);
            if ($this->canObjectAcceptVendorId($child)) {
                $this->copyVendorId($child, $this->vendorId);
            } else {
                $this->applyChildrenVendorId($childName);
            }
        }
        return $this;
    }
    
}