<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorConfig\App\Config\Source\RuntimeConfigSource;

/**
 * Runtime config source vendor trait
 */
trait VendorTrait
{
    
    /**
     * Load config
     * 
     * @return array
     */
    protected function vendorLoadConfig()
    {
        try {
            $collection = $this->vendorCollectionFactory->create();
        } catch (\DomainException $e) {
            $collection = [];
        }
        $config = [];
        foreach ($collection as $item) {
            if ($item->getScope() === \Magento\Framework\App\Config\ScopeConfigInterface::SCOPE_TYPE_DEFAULT) {
                $config[$item->getScope()][$item->getPath()] = $item->getValue();
            } else {
                $code = $this->vendorScopeCodeResolver->resolve($item->getScope(), $item->getScopeId());
                $config[$item->getScope()][$code][$item->getPath()] = $item->getValue();
            }
        }
        foreach ($config as $scope => &$item) {
            if ($scope === \Magento\Framework\App\Config\ScopeConfigInterface::SCOPE_TYPE_DEFAULT) {
                $item = $this->vendorConverter->convert($item);
            } else {
                foreach ($item as &$scopeItems) {
                    $scopeItems = $this->vendorConverter->convert($scopeItems);
                }
            }
        }
        return $config;
    }
    
    /**
     * Load vendor config
     * 
     * @return array
     */
    protected function vendorLoadVendorConfig()
    {
        try {
            $collection = $this->vendorCollectionFactory->create();
            if ($collection->getConnection()->isTableExists('ecombricks_vendor_core_config_data')) {
                $collection->setMainTable('ecombricks_vendor_core_config_data');
            } else {
                $collection = [];
            }
        } catch (\DomainException $e) {
            $collection = [];
        }
        $config = [];
        foreach ($collection as $item) {
            $vendorId = $item->getVendorId();
            $vendorCode = $this->vendorManagement->getVendorCode($vendorId);
            if (empty($vendorCode)) {
                continue;
            }
            if ($item->getScope() === \Magento\Framework\App\Config\ScopeConfigInterface::SCOPE_TYPE_DEFAULT) {
                $config[$item->getScope()]['vendors'][$vendorCode][$item->getPath()] = $item->getValue();
            } else {
                $code = $this->vendorScopeCodeResolver->resolve($item->getScope(), $item->getScopeId());
                $config[$item->getScope()][$code]['vendors'][$vendorCode][$item->getPath()] = $item->getValue();
            }
        }
        foreach ($config as $scope => &$item) {
            if ($scope === \Magento\Framework\App\Config\ScopeConfigInterface::SCOPE_TYPE_DEFAULT) {
                foreach ($item['vendors'] as $vendorCode => &$vendorItem) {
                    $vendorItem = $this->vendorConverter->convert($vendorItem);
                }
            } else {
                foreach ($item as &$scopeItems) {
                    foreach ($scopeItems['vendors'] as $vendorCode => &$vendorItem) {
                        $vendorItem = $this->vendorConverter->convert($vendorItem);
                    }
                }
            }
        }
        return $config;
    }

    /**
     * Get data
     * 
     * @param string $path
     * @return array
     */
    public function vendorGet($path = '')
    {
        $dataObject = new \Magento\Framework\DataObject(
            array_merge_recursive($this->vendorLoadConfig(), $this->vendorLoadVendorConfig())
        );
        $this->vendorManagement->clear();
        return $dataObject->getData($path) ?: [];
    }

}