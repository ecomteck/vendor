<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Plugin\Framework\View\Model\Layout;

/**
 * Layout merge model plugin
 */
class Merge
{
    
    /**
     * Around get file layout updates XML
     * 
     * @param \Magento\Framework\View\Model\Layout\Merge $subject
     * @param \Closure $proceed
     * @return string
     */
    public function aroundGetFileLayoutUpdatesXml(
        \Magento\Framework\View\Model\Layout\Merge $subject,
        \Closure $proceed
    )
    {
        $subject->vendorInitCacheSuffix();
        return $proceed();
    }
    
    /**
     * Around get cache ID
     * 
     * @param \Magento\Framework\View\Model\Layout\Merge $subject
     * @param \Closure $proceed
     * @return string
     */
    public function aroundGetCacheId(
        \Magento\Framework\View\Model\Layout\Merge $subject,
        \Closure $proceed
    )
    {
        return $subject->vendorGetCacheId();
    }
    
}