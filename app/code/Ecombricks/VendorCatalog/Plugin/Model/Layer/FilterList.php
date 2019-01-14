<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCatalog\Plugin\Model\Layer;

/**
 * Layer filter list model plugin
 */
class FilterList
{
    
    /**
     * Around get filters
     * 
     * @param \Magento\Catalog\Model\Layer\FilterList $subject
     * @param \Closure $proceed
     * @param \Magento\Catalog\Model\Layer $layer
     * @return array|\Magento\Catalog\Model\Layer\Filter\AbstractFilter[]
     */
    public function aroundGetFilters(
        \Magento\Catalog\Model\Layer\FilterList $subject,
        \Closure $proceed,
        \Magento\Catalog\Model\Layer $layer
    )
    {
        $result = $proceed($layer);
        $vendorFilter = $subject->createVendorFilter($layer);
        if ($vendorFilter) {
            $result[] = $vendorFilter;
        }
        return $result;
    }
    
}