<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCatalog\Model\ResourceModel\Product\Collection;

/**
 * Product collection vendor trait
 */
trait VendorTrait
{
    
    /**
     * Vendor product count select
     *
     * @var \Magento\Framework\DB\Select
     */
    protected $vendorProductCountSelect;
    
    /**
     * Get vendor product count select
     *
     * @return \Magento\Framework\DB\Select
     */
    public function getVendorProductCountSelect()
    {
        if ($this->vendorProductCountSelect === null) {
            $this->vendorProductCountSelect = clone $this->getSelect();
            $this->vendorProductCountSelect
                ->reset(\Magento\Framework\DB\Select::COLUMNS)
                ->reset(\Magento\Framework\DB\Select::GROUP)
                ->reset(\Magento\Framework\DB\Select::ORDER)
                ->distinct(false)
                ->join(
                    ['count_table' => $this->getTable('ecombricks_vendor_catalog_product_entity')], 
                    'count_table.entity_id = e.entity_id',
                    [
                        'count_table.vendor_id',
                        'product_count' => new \Zend_Db_Expr('COUNT(DISTINCT count_table.entity_id)')
                    ]
                )
                ->group('count_table.vendor_id');
        }
        return $this->vendorProductCountSelect;
    }
    
    /**
     * Unset vendor product count select
     *
     * @return $this
     */
    public function unsVendorProductCountSelect()
    {
        $this->vendorProductCountSelect = null;
        return $this;
    }
    
    /**
     * Add count to vendors
     * 
     * @param \Ecombricks\Vendor\Model\Vendor[] $vendors
     * @return $this
     */
    public function addCountToVendors($vendors)
    {
        $vendorIds = [];
        foreach ($vendors as $vendor) {
            $vendorIds[] = (int) $vendor->getId();
        }
        $productCounts = [];
        $select = $this->getVendorProductCountSelect();
        $select->limit();
        $connection = $this->getConnection();
        $vendorIdField = $connection->quoteIdentifier('count_table.vendor_id');
        $select->where($vendorIdField.' IN (?)', $vendorIds);
        $productCounts += $this->getConnection()->fetchPairs($select);
        $this->unsVendorProductCountSelect();
        foreach ($vendors as $vendor) {
            $count = 0;
            if (isset($productCounts[$vendor->getId()])) {
                $count = $productCounts[$vendor->getId()];
            }
            $vendor->setProductCount($count);
        }
        return $this;
    }
    
}