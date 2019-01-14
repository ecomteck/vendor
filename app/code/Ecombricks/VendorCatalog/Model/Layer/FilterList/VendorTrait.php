<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCatalog\Model\Layer\FilterList;

/**
 * Layer filter list model vendor trait
 */
trait VendorTrait
{
    
    /**
     * Create vendor filter
     *
     * @param \Magento\Catalog\Model\Layer $layer
     * @return \Magento\Catalog\Model\Layer\Filter\AbstractFilter
     */
    public function createVendorFilter(
        \Magento\Catalog\Model\Layer $layer
    )
    {
        return $this->objectManager->create($this->filterTypes['vendor'], [ 'layer' => $layer ]);
    }
    
}