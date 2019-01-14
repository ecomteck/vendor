<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCatalog\Ui\DataProvider\Product;

/**
 * Add vendor filter to collection
 */
class AddVendorFilterToCollection implements \Magento\Ui\DataProvider\AddFilterToCollectionInterface
{
    
    /**
     * Add filter
     * 
     * @param \Magento\Framework\Data\Collection $collection
     * @param string $field
     * @param string|null $condition
     * @return void
     */
    public function addFilter(\Magento\Framework\Data\Collection $collection, $field, $condition = null)
    {
        if (array_key_exists('eq', $condition) && ($condition['eq'] !== null)) {
            $select = $collection->getSelect();
            $attributeTableAliasPrefix = \Magento\Eav\Model\Entity\Collection\AbstractCollection::ATTRIBUTE_TABLE_ALIAS_PREFIX;
            $select->where($attributeTableAliasPrefix.'vendor_id.vendor_id = ?', $condition['eq']);
        }
    }
    
}