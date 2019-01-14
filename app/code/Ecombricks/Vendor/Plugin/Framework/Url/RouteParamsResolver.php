<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Plugin\Framework\Url;

/**
 * URL route params resolver plugin
 */
class RouteParamsResolver
{
    
    /**
     * Around get URL
     * 
     * @param \Magento\Framework\Url\RouteParamsResolver $subject
     * @param \Closure $proceed
     * @param array $data
     * @param bool $unsetOldParams
     * @return \Magento\Framework\Url\RouteParamsResolverInterface
     */
    public function aroundSetRouteParams(
        \Magento\Framework\Url\RouteParamsResolver $subject,
        \Closure $proceed,
        array $data,
        $unsetOldParams = true
    )
    {
        $result = $proceed($data, $unsetOldParams);
        $subject->vendorAfterSetRouteParams();
        return $result;
    }
    
}