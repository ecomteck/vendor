<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Framework\Model\ResourceModel\Db\Collection;

/**
 * Collection vendor trait
 */
trait VendorTrait
{
    
    /**
     * Vendor ID loaded
     *
     * @var bool
     */
    protected $vendorIdLoaded = false;
    
    /**
     * Initial main table
     * 
     * @var string
     */
    protected $initialMainTable;
    
    /**
     * Check if EAV
     * 
     * @return bool
     */
    public function vendorIsEAV()
    {
        return $this instanceof \Magento\Eav\Model\Entity\Collection\AbstractCollection;
    }
    
    /**
     * Initialize main table
     * 
     * @return $this
     */
    public function vendorInitMainTable()
    {
        if (empty($this->vendorMainTable) || $this->vendorIsEAV()) {
            return $this;
        }
        if ($this->initialMainTable == null) {
            $this->initialMainTable = $this->getMainTable();
        }
        if ($this->getVendorId()) {
            $this->setMainTable($this->vendorMainTable);
        } else {
            $this->_mainTable = $this->initialMainTable;
        }
        return $this;
    }
    
    /**
     * After set vendor ID
     * 
     * @param int $vendorId
     * @return $this
     */
    public function afterSetVendorId($vendorId)
    {
        if (!$this->hasVendorTableDefined()) {
            $this->vendorInitMainTable();
        }
        if ($vendorId) {
            $this->addVendorFilter($vendorId);
        }
        return $this;
    }
    
    /**
     * Check if vendor table is defined
     * 
     * @return bool
     */
    public function hasVendorTableDefined()
    {
        return !empty($this->vendorTable);
    }
    
    /**
     * Get vendor table
     * 
     * @return string
     */
    public function getVendorTable()
    {
        if ($this->hasVendorTableDefined()) {
            return $this->getTable($this->vendorTable);
        }
        return ($this->vendorIsEAV()) ? $this->getEntity()->getEntityTable() : $this->getMainTable();
    }
    
    /**
     * Get main table alias
     * 
     * @return string
     */
    public function getMainTableAlias()
    {
        return ($this->vendorIsEAV()) ? 'e' : 'main_table';
    }
    
    /**
     * Get vendor table alias
     * 
     * @return string
     */
    public function getVendorTableAlias()
    {
        if ($this->hasVendorTableDefined()) {
            return 'vendor_table';
        }
        return $this->getMainTableAlias();
    }
    
    /**
     * Get main table entity id field name
     * 
     * @return string
     */
    public function getMainTableEntityIdFieldName()
    {
        if (!empty($this->mainTableEntityIdFieldName)) {
            return $this->mainTableEntityIdFieldName;
        }
        return $this->getResource()->getIdFieldName();
    }
    
    /**
     * Get vendor table entity id field name
     * 
     * @return string
     */
    public function getVendorTableEntityIdFieldName()
    {
        if (!empty($this->vendorTableEntityIdFieldName)) {
            return $this->vendorTableEntityIdFieldName;
        }
        return $this->getResource()->getIdFieldName();
    }
    
    /**
     * Add vendor field
     * 
     * @return $this
     */
    public function addVendorField()
    {
        if (!$this->hasVendorTableDefined()) {
            return $this;
        }
        $connection = $this->getConnection();
        $select = $this->getSelect();
        $fromPart = $select->getPart(\Magento\Framework\DB\Select::FROM);
        if (!isset($fromPart['vendor_table'])) {
            $mainTableAlias = $this->getMainTableAlias();
            $mainTableEntityIdFieldName = $this->getMainTableEntityIdFieldName();
            $mainTableEntityIdFieldNameFull = $mainTableAlias.'.'.$mainTableEntityIdFieldName;
            $vendorTableEntityIdFieldName = $this->getVendorTableEntityIdFieldName();
            $select->join(
                ['vendor_table' => $this->getVendorTable()],
                $mainTableEntityIdFieldNameFull.' = vendor_table.'.$vendorTableEntityIdFieldName,
                ['vendor_id']
            );
            if ($mainTableEntityIdFieldName == $vendorTableEntityIdFieldName) {
                $wherePart = $select->getPart(\Magento\Framework\DB\Select::WHERE);
                if (count($wherePart)) {
                    $mainTableEntityIdFieldNameQuoted = $connection->quoteIdentifier($mainTableEntityIdFieldName);
                    $mainTableEntityIdFieldNameFullQuoted = $connection->quoteIdentifier($mainTableEntityIdFieldNameFull);
                    foreach ($wherePart as &$whereCondition) {
                        if (
                            (strpos($whereCondition, $mainTableEntityIdFieldNameQuoted) !== false) && 
                            (strpos($whereCondition, $mainTableEntityIdFieldNameFullQuoted) === false)
                        ) {
                            $whereCondition = str_replace(
                                $mainTableEntityIdFieldNameQuoted,
                                $mainTableEntityIdFieldNameFullQuoted, 
                                $whereCondition
                            );
                        }

                    }
                    $select->setPart(\Magento\Framework\DB\Select::WHERE, $wherePart);
                }
                $this->addFilterToMap($mainTableEntityIdFieldName, $mainTableEntityIdFieldNameFull);
            }
            $this->vendorIdLoaded = true;
        }
        return $this;
    }
    
    /**
     * Before add vendor filter
     * 
     * @param int $vendorId
     * @return $this
     */
    public function beforeAddVendorFilter($vendorId)
    {
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
        $this->beforeAddVendorFilter($vendorId);
        $this->addVendorField();
        $connection = $this->getConnection();
        $select = $this->getSelect();
        $vendorIdField = $connection->quoteIdentifier($this->getVendorTableAlias().'.vendor_id');
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
        $this->addVendorField();
        $connection = $this->getConnection();
        $select = $this->getSelect();
        $vendorIdField = $connection->quoteIdentifier($this->getVendorTableAlias().'.vendor_id');
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
     * Get vendor ID data
     * 
     * @return array
     */
    public function getVendorIdData()
    {
        $vendorId = [];
        $ids = [];
        $entityIdFieldName = $this->getMainTableEntityIdFieldName();
        foreach ($this->_items as $object) {
            $ids[] = (int) $object->getData($entityIdFieldName);
        }
        if (empty($ids)) {
            return $vendorId;
        }
        $connection = $this->getConnection();
        $vendorEntityIdFieldName = $this->getVendorTableEntityIdFieldName();
        $select = $connection->select()
            ->from($this->getVendorTable())
            ->where($vendorEntityIdFieldName.' IN (?)', $ids);
        $rows = $connection->fetchAll($select);
        if (!empty($rows)) {
            foreach ($rows as $row) {
                $id = (int) $row[$vendorEntityIdFieldName];
                $vendorId[$id] = (int) $row['vendor_id'];
            }
        }
        return $vendorId;
    }
    
    /**
     * Load vendor ID data
     * 
     * @return $this
     */
    public function loadVendorIdData()
    {
        if (!$this->hasVendorTableDefined()) {
            return $this;
        }
        if ($this->vendorIdLoaded) {
            return $this;
        }
        $vendorId = $this->getVendorIdData();
        $entityIdFieldName = $this->getMainTableEntityIdFieldName();
        foreach ($this->_items as $object) {
            $id = (int) $object->getData($entityIdFieldName);
            $object->setVendorId(!empty($vendorId[$id]) ? $vendorId[$id] : 0);
        }
        $this->vendorIdLoaded = true;
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
        $vendorId = $this->getVendorId();
        if ($this->hasVendorTableDefined() || $vendorId) {
            if ($vendorId) {
                $this->addVendorFilter($vendorId);
            }
            $this->addAvailableVendorsFilter();
        }
        return $this;
    }
    
    /**
     * After load
     * 
     * @return $this
     */
    public function vendorAfterLoad()
    {
        $this->loadVendorIdData();
        return $this;
    }
    
}