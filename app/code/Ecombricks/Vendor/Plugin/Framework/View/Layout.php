<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Plugin\Framework\View;

/**
 * Layout plugin
 */
class Layout
{
    
    /**
     * Around render element
     * 
     * @param \Magento\Framework\View\Layout $subject
     * @param \Closure $proceed
     * @param string $name
     * @param bool $useCache
     * @return string
     */
    public function aroundRenderElement(
        \Magento\Framework\View\Layout $subject,
        \Closure $proceed,
        $name,
        $useCache = true
    )
    {
        return $subject->vendorRenderElement($name, $useCache);
    }
    
}