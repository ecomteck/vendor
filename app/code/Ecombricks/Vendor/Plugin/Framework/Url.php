<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Plugin\Framework;

/**
 * URL plugin
 */
class Url
{
    
    /**
     * Around get URL
     * 
     * @param \Magento\Framework\Url $subject
     * @param \Closure $proceed
     * @param string|null $routePath
     * @param array|null $routeParams
     * @return string
     */
    public function aroundGetUrl(
        \Magento\Framework\Url $subject,
        \Closure $proceed,
        $routePath = null,
        $routeParams = null
    )
    {
        $modifiedRouteParams = $subject->vendorBeforeGetUrl($routePath, $routeParams);
        return $proceed($routePath, $modifiedRouteParams);
    }
    
}