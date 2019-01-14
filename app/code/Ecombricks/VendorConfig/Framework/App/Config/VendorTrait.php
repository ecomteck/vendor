<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorConfig\Framework\App\Config;

/**
 * Config vendor trait
 */
trait VendorTrait
{
    
    /**
     * Get config value
     *
     * @param string $path
     * @param string $scope
     * @param null|string $scopeCode
     * @return mixed
     */
    public function vendorGetValue(
        $path = null,
        $scope = \Magento\Framework\App\Config\ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
        $scopeCode = null
    )
    {
        if ($scope === 'store') {
            $scope = 'stores';
        } elseif ($scope === 'website') {
            $scope = 'websites';
        }
        $configPath = $scope;
        if ($scope !== 'default') {
            if (is_numeric($scopeCode) || $scopeCode === null) {
                $scopeCode = $this->vendorScopeCodeResolver->resolve($scope, $scopeCode);
            } else if ($scopeCode instanceof \Magento\Framework\App\ScopeInterface) {
                $scopeCode = $scopeCode->getCode();
            }
            if ($scopeCode) {
                $configPath .= '/'.$scopeCode;
            }
        }
        $vendorId = $this->getVendorId();
        $vendorValue = null;
        if ($vendorId) {
            $vendorCode = $this->vendorManagement->getVendorCode($vendorId);
            $vendorValue = $this->get('system', $configPath.'/vendors/'.$vendorCode.(($path) ? '/'.$path :''));
        }
        if (($vendorValue !== null) && !is_array($vendorValue)) {
            return $vendorValue;
        }
        $value = $this->get('system', $configPath.(($path) ? '/'.$path :''));
        if (($vendorValue !== null) && is_array($vendorValue)) {
            if (is_array($value)) {
                $value = array_replace_recursive($value, $vendorValue);
            } else {
                $value = $vendorValue;
            }
        }
        return $value;
    }
    
}