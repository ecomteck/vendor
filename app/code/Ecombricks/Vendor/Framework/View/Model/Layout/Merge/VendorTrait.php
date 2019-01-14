<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Framework\View\Model\Layout\Merge;

/**
 * Layout merge model vendor trait
 */
trait VendorTrait
{
    
    /**
     * Initialize cache suffix
     * 
     * @return $this
     */
    public function vendorInitCacheSuffix()
    {
        if (!$this->vendorManagement->isCurrentUserVendor()) {
            return $this;
        }
        if (strpos($this->cacheSuffix, 'vendor') === false) {
            $this->cacheSuffix .= '|vendor';
        }
        return $this;
    }
    
    /**
     * Get cache ID
     *
     * @return string
     */
    public function vendorGetCacheId()
    {
        $handles = $this->getHandles();
        if ($this->vendorManagement->isCurrentUserVendor()) {
            $handles[] = 'vendor';
        }
        return $this->generateCacheId(md5(implode('|', $handles)));
    }
    
}