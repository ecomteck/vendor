<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCatalog\Ui\DataProvider\Product;

/**
 * Add vendor field to collection
 */
class AddVendorFieldToCollection implements \Magento\Ui\DataProvider\AddFieldToCollectionInterface
{
    
    /**
     * Add field
     *
     * @param \Magento\Framework\Data\Collection $collection
     * @param string $field
     * @param string|null $alias
     * @return void
     */
    public function addField(\Magento\Framework\Data\Collection $collection, $field, $alias = null)
    {
        $collection->joinField(
            'vendor_id',
            'ecombricks_vendor_catalog_product_entity',
            'vendor_id',
            'entity_id=entity_id',
            null,
            'inner'
        );
    }
    
}