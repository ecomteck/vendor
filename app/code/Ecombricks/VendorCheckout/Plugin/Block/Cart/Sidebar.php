<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Plugin\Block\Cart;

/**
 * Cart sidebar block plugin
 */
class Sidebar
{
    
    /**
     * Around get URL
     * 
     * @param \Magento\Checkout\Block\Cart\Sidebar $subject
     * @param \Closure $proceed
     * @param string $route
     * @param array $params
     * @return string
     */
    public function aroundGetUrl(
        \Magento\Checkout\Block\Cart\Sidebar $subject,
        \Closure $proceed,
        $route = '',
        $params = []
    )
    {
        if (!is_array($params)) {
            $params = [];
        }
        if ($route) {
            $routeParts = explode('/', $route);
            if (count($routeParts) < 3) {
                for ($index = 0; $index < 3; $index++) {
                    if (!isset($routeParts[$index])) {
                        $routeParts[$index] = 'index';
                    }
                }
                $route = implode('/', $routeParts);
            }
        }
        $params['_exclude_vendor'] = true;
        return $proceed($route, $params);
    }
    
}