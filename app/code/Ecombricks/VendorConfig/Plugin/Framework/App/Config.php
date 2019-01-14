<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorConfig\Plugin\Framework\App;

/**
 * Config plugin
 */
class Config
{
    
    /**
     * Around get value
     * 
     * @param \Magento\Framework\App\Config $subject
     * @param \Closure $proceed
     * @param string $path
     * @param string $scope
     * @param null|string $scopeCode
     * @return mixed
     */
    public function aroundGetValue(
        \Magento\Framework\App\Config $subject,
        \Closure $proceed,
        $path = null,
        $scope = \Magento\Framework\App\Config\ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
        $scopeCode = null
    )
    {
        if ($path == 'sales/dashboard/use_aggregated_data') {
            return 0;
        }
        return $subject->vendorGetValue($path, $scope, $scopeCode);
    }
    
}