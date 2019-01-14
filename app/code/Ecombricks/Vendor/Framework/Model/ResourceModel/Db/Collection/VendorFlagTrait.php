<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Framework\Model\ResourceModel\Db\Collection;

/**
 * Collection vendor flag trait
 */
trait VendorFlagTrait
{
    
    /**
     * Either vendor flag is loaded or not
     *
     * @var bool
     */
    protected $vendorFlagLoaded = false;
    
    /**
     * After set is vendor
     * 
     * @return $this
     */
    public function afterSetIsVendor()
    {
        $isVendor = $this->getIsVendor();
        if ($isVendor !== null) {
            $this->addIsVendorFilter($isVendor);
        }
        return $this;
    }
    
    /**
     * Get is vendor expression
     * 
     * @return \Zend_Db_Expr
     */
    protected function getIsVendorExpr()
    {
        return new \Zend_Db_Expr("IF ({$this->getConnection()->quoteIdentifier('is_vendor_table.is_vendor')} = 1, 1, 0)");
    }
    
    /**
     * Add is vendor field
     * 
     * @return $this
     */
    public function addIsVendorField()
    {
        $connection = $this->getConnection();
        $select = $this->getSelect();
        $fromPart = $select->getPart(\Magento\Framework\DB\Select::FROM);
        if (!isset($fromPart['is_vendor_table'])) {
            $resource = $this->getResource();
            $idFieldName = $resource->getIdFieldName();
            $mainTableAlias = ($this instanceof \Magento\Eav\Model\Entity\Collection\AbstractCollection) ? 'e' : 'main_table';
            $mainTableIdFieldNameFull = $mainTableAlias.'.'.$idFieldName;
            $select->joinLeft(
                ['is_vendor_table' => $this->getTable($this->isVendorTable)],
                $mainTableIdFieldNameFull.' = is_vendor_table.'.$idFieldName,
                []
            );
            $isVendorFieldExpr = $this->getIsVendorExpr();
            $this->addFilterToMap('is_vendor', $isVendorFieldExpr);
            $this->addExpressionFieldToSelect('is_vendor', $isVendorFieldExpr, []);
            $wherePart = $select->getPart(\Magento\Framework\DB\Select::WHERE);
            if (count($wherePart)) {
                $idFieldNameQuoted = $connection->quoteIdentifier($idFieldName);
                $mainTableIdFieldNameFullQuoted = $connection->quoteIdentifier($mainTableIdFieldNameFull);
                foreach ($wherePart as &$whereCondition) {
                    if (
                        (strpos($whereCondition, $idFieldNameQuoted) !== false) || 
                        (strpos($whereCondition, $mainTableIdFieldNameFullQuoted) === false)
                    ) {
                        $whereCondition = str_replace(
                            $idFieldNameQuoted,
                            $mainTableIdFieldNameFullQuoted, 
                            $whereCondition
                        );
                    }

                }
                $select->setPart(\Magento\Framework\DB\Select::WHERE, $wherePart);
            }
            $this->addFilterToMap($idFieldName, $mainTableIdFieldNameFull);
            $this->vendorFlagLoaded = true;
        }
        return $this;
    }
    
    /**
     * Add is vendor filter
     * 
     * @param int $isVendor
     * @return $this
     */
    public function addIsVendorFilter($isVendor)
    {
        $this->addIsVendorField();
        $select = $this->getSelect();
        $wherePart = $select->getPart(\Magento\Framework\DB\Select::WHERE);
        $isVendorFieldExpr = (string) $this->getIsVendorExpr();
        $isFilterAdded = false;
        foreach ($wherePart as $whereCondition) {
            if (strpos($whereCondition, $isVendorFieldExpr) !== false) {
                $isFilterAdded = true;
                break;
            }
        }
        if (!$isFilterAdded) {
            $this->addFieldToFilter('is_vendor', ['eq' => ($isVendor) ? 1 : 0]);
        }
        return $this;
    }
    
    /**
     * Get is vendor data
     * 
     * @return array
     */
    public function getIsVendorData()
    {
        $isVendor = [];
        $ids = [];
        foreach ($this->_items as $item) {
            $ids[] = (int) $item->getId();
        }
        if (empty($ids)) {
            return $isVendor;
        }
        $connection = $this->getConnection();
        $resource = $this->getResource();
        $idFieldName = $resource->getIdFieldName();
        $select = $connection->select()
            ->from($resource->getTable($this->isVendorTable))
            ->where($idFieldName.' IN (?)', $ids);
        $rows = $connection->fetchAll($select);
        if (!empty($rows)) {
            foreach ($rows as $row) {
                $id = (int) $row[$idFieldName];
                $isVendor[$id] = ($row['is_vendor']) ? 1 : 0;
            }
        }
        return $isVendor;
    }
    
    /**
     * Load is vendor data
     * 
     * @return $this
     */
    public function loadIsVendorData()
    {
        if ($this->vendorFlagLoaded) {
            return $this;
        }
        $isVendor = $this->getIsVendorData();
        foreach ($this->_items as $item) {
            $id = (int) $item->getId();
            $item->setIsVendor(isset($isVendor[$id]) ? $isVendor[$id] : 0);
        }
        $this->vendorFlagLoaded = true;
        return $this;
    }
    
    /**
     * After load
     * 
     * @return $this
     */
    public function vendorFlagAfterLoad()
    {
        $this->loadIsVendorData();
        return $this;
    }
    
}