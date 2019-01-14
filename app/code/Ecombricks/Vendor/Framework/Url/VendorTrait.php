<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Framework\Url;

/**
 * URL Vendor trait
 */
trait VendorTrait
{
    
    /**
     * Route params resolver
     * 
     * @var \Magento\Framework\Url\RouteParamsResolverInterface 
     */
    protected $vendorRouteParamsResolver;
    
    /**
     * Before get URL
     * 
     * @param string|null $routePath
     * @param array|null $routeParams
     * @return array
     */
    public function vendorBeforeGetUrl($routePath, $routeParams)
    {
        $vendorId = $this->getVendorId();
        if ($routeParams === null) {
            $routeParams = [];
        }
        if (!$vendorId || isset($routeParams['vendor']) || isset($routeParams['_exclude_vendor'])) {
            return $routeParams;
        }
        if (!isset($this->vendorParameterActionPathPatterns)) {
            $routeParams['_exclude_vendor'] = true;
            return $routeParams;
        }
        $actionPathPatterns = (array) $this->vendorParameterActionPathPatterns;
        $this->_setRoutePath($routePath);
        $actionPath = $this->_getActionPath();
        $isAppendVendorParameter = false;
        foreach ($actionPathPatterns as $actionPathPattern) {
            if (!$actionPathPattern) {
                continue;
            }
            if (preg_match(trim($actionPathPattern), $actionPath)) {
                $isAppendVendorParameter = true;
                break;
            }
        }
        if (!$isAppendVendorParameter) {
            $routeParams['_exclude_vendor'] = true;
        }
        return $routeParams;
    }
    
    /**
     * Get route params resolver
     *
     * @return Magento\Framework\Url\RouteParamsResolverInterface
     */
    protected function getRouteParamsResolver()
    {
        if (!$this->vendorRouteParamsResolver) {
            $this->vendorRouteParamsResolver = $this->vendorRouteParamsResolverFactory->create();
        }
        return $this->vendorRouteParamsResolver;
    }
    
}