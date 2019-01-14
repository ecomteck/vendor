<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Framework\Model\ResourceModel\Db;

/**
 * Resource model vendor trait
 */
trait VendorTrait
{
    
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
        return $this instanceof \Magento\Eav\Model\Entity\AbstractEntity;
    }
    
    /**
     * Initialize main table
     * 
     * @param \Magento\Framework\Model\AbstractModel|\Magento\Framework\DataObject $object
     * @return $this
     */
    public function vendorInitMainTable($object)
    {
        if (empty($this->vendorMainTable) || $this->vendorIsEAV()) {
            return $this;
        }
        if ($this->initialMainTable == null) {
            $this->initialMainTable = $this->_mainTable;
        }
        if ($object->getVendorId()) {
            $this->_mainTable = $this->vendorMainTable;
        } else {
            $this->_mainTable = $this->initialMainTable;
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
        return ($this->vendorIsEAV()) ? $this->getEntityTable() : $this->getMainTable();
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
        return $this->getIdFieldName();
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
        return $this->getIdFieldName();
    }
    
    /**
     * Get vendor ID
     * 
     * @param \Magento\Framework\Model\AbstractModel|\Magento\Framework\DataObject $object
     * @return int|null
     */
    public function getVendorId($object)
    {
        $entityId = (int) $object->getData($this->getMainTableEntityIdFieldName());
        if (empty($entityId)) {
            return null;
        }
        $connection = $this->getConnection();
        $select = $connection->select()
            ->from($this->getVendorTable(), ['vendor_id'])
            ->where($this->getVendorTableEntityIdFieldName().' = ?', $entityId);
        $vendorId = $connection->fetchOne($select);
        return ($vendorId) ? (int) $vendorId : null;
    }
    
    /**
     * Load vendor ID
     * 
     * @param \Magento\Framework\Model\AbstractModel|\Magento\Framework\DataObject $object
     * @return $this
     */
    public function loadVendorId($object)
    {
        if (!$this->hasVendorTableDefined()) {
            return $this;
        }
        $object->setVendorId($this->getVendorId($object));
        return $this;
    }
    
    /**
     * Delete vendor ID
     * 
     * @param \Magento\Framework\Model\AbstractModel|\Magento\Framework\DataObject $object
     * @return $this
     */
    public function deleteVendorId($object)
    {
        if (!$this->hasVendorTableDefined()) {
            return $this;
        }
        if (!empty($this->mainTableEntityIdFieldName) || !empty($this->vendorTableEntityIdFieldName)) {
            return $this;
        }
        $connection = $this->getConnection();
        $id = (int) $object->getId();
        if (empty($id)) {
            return $this;
        }
        $connection->delete($this->getVendorTable(), [$this->getIdFieldName().' = ?' => $id]);
        return $this;
    }
    
    /**
     * Save vendor ID
     * 
     * @param \Magento\Framework\Model\AbstractModel|\Magento\Framework\DataObject $object
     * @return $this
     */
    public function saveVendorId($object)
    {
        if (!$this->hasVendorTableDefined()) {
            return $this;
        }
        if (!empty($this->mainTableEntityIdFieldName) || !empty($this->vendorTableEntityIdFieldName)) {
            return $this;
        }
        $connection = $this->getConnection();
        $id = (int) $object->getId();
        if (empty($id)) {
            return $this;
        }
        $vendorId = (int) $object->getVendorId();
        if (empty($vendorId)) {
            $this->deleteVendorId($object);
            return $this;
        }
        $oldVendorId = $this->getVendorId($object);
        if (empty($oldVendorId)) {
            $connection->insert($this->getVendorTable(), [$this->getIdFieldName() => $id, 'vendor_id' => $vendorId]);
            return $this;
        }
        if ($oldVendorId !== $vendorId) {
            $connection->update($this->getVendorTable(), ['vendor_id' => $vendorId], [$this->getIdFieldName().' = ?' => $id]);
            return $this;
        }
        return $this;
    }
    
}