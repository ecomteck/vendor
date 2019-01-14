<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Framework\Url\RouteParamsResolver;

/**
 * URL route params resolver vendor trait
 */
trait VendorTrait
{
    
    /**
     * After set route params
     * 
     * @return $this
     */
    public function vendorAfterSetRouteParams()
    {
        $params = $this->_getData('route_params');
        if (!is_array($params)) {
            $params = [];
        }
        if (isset($params['_exclude_vendor'])) {
            unset($params['_exclude_vendor']);
            if (isset($params['vendor'])) {
                unset($params['vendor']);
            }
            $this->setData('route_params', $params);
            return $this;
        }
        $vendorId = $this->getVendorId();
        if ($vendorId && !isset($params['vendor'])) {
            $params['vendor'] = $vendorId;
        }
        $this->setData('route_params', $params);
        return $this;
    }
    
}