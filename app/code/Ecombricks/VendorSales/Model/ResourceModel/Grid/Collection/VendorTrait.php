<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Model\ResourceModel\Grid\Collection;

/**
 * Collection vendor trait
 */
trait VendorTrait
{
    
    /**
     * After set vendor ID
     * 
     * @param int $vendorId
     * @return $this
     */
    public function afterSetVendorId($vendorId)
    {
        if ($vendorId) {
            $this->addVendorFilter($vendorId);
        }
        return $this;
    }
    
    /**
     * Add vendor filter
     * 
     * @param int $vendorId
     * @return $this
     */
    public function addVendorFilter($vendorId)
    {
        $connection = $this->getConnection();
        $select = $this->getSelect();
        $vendorIdField = $connection->quoteIdentifier('main_table.vendor_id');
        $conditionPrefix = $vendorIdField.' = ';
        $condition = $conditionPrefix.'?';
        $wherePart = $select->getPart(\Magento\Framework\DB\Select::WHERE);
        $isFilterAdded = false;
        foreach ($wherePart as $whereCondition) {
            if (strpos($whereCondition, $conditionPrefix) !== false) {
                $isFilterAdded = true;
                break;
            }
        }
        if (!$isFilterAdded) {
            $select->where($condition, $vendorId);
        }
        return $this;
    }
    
    /**
     * Add vendors filter
     * 
     * @param array $vendorIds
     * @return $this
     */
    public function addVendorsFilter($vendorIds)
    {
        $connection = $this->getConnection();
        $select = $this->getSelect();
        $vendorIdField = $connection->quoteIdentifier('main_table.vendor_id');
        $conditionPrefix = $vendorIdField.' IN ';
        $condition = $conditionPrefix.'(?)';
        $wherePart = $select->getPart(\Magento\Framework\DB\Select::WHERE);
        $isFilterAdded = false;
        foreach ($wherePart as $whereCondition) {
            if (strpos($whereCondition, $conditionPrefix) !== false) {
                $isFilterAdded = true;
                break;
            }
        }
        if (!$isFilterAdded) {
            $select->where($condition, $vendorIds);
        }
        return $this;
    }
    
    /**
     * Add available vendors filter
     * 
     * @return $this
     */
    public function addAvailableVendorsFilter()
    {
        $this->addVendorsFilter($this->vendorManagement->getAvailableVendorIds());
        return $this;
    }
    
    /**
     * Before load
     * 
     * @return $this
     */
    public function vendorBeforeLoad()
    {
        if ($this->isLoaded()) {
            return $this;
        }
        $this->addAvailableVendorsFilter();
        return $this;
    }
    
}