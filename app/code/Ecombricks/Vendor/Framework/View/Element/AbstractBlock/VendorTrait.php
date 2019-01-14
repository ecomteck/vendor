<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Framework\View\Element\AbstractBlock;

/**
 * Abstract block vendor trait
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
        $this->applyChildrenVendorId($this->getNameInLayout());
        return $this;
    }
    
    /**
     * Set children vendor ID
     * 
     * @param string $name
     * @return $this
     */
    protected function applyChildrenVendorId($name)
    {
        $layout = $this->getLayout();
        $childNames = $layout->getChildNames($name);
        if (!count($childNames)) {
            return $this;
        }
        foreach ($childNames as $childName) {
            $child = $layout->getBlock($childName);
            if ($this->canObjectAcceptVendorId($child)) {
                $this->copyVendorId($child, $this->getVendorId());
            } else {
                $this->applyChildrenVendorId($childName);
            }
        }
        return $this;
    }
    
}