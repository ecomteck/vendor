<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Framework\Model\ResourceModel\Db;

/**
 * Model resource vendor flag trait
 */
trait VendorFlagTrait
{
    
    /**
     * Get is vendor
     * 
     * @param \Magento\Framework\Model\AbstractModel|\Magento\Framework\DataObject $object
     * @return int|null
     */
    public function getIsVendor($object)
    {
        $connection = $this->getConnection();
        $id = (int) $object->getId();
        if (empty($id)) {
            return null;
        }
        $select = $connection->select()
            ->from($this->getTable($this->isVendorTable), ['is_vendor'])
            ->where($this->getIdFieldName().' = ?', $id);
        $isVendor = $connection->fetchOne($select);
        return ($isVendor) ? 1 : 0;
    }
    
    /**
     * Load is vendor
     * 
     * @param \Magento\Framework\Model\AbstractModel|\Magento\Framework\DataObject $object
     * @return $this
     */
    public function loadIsVendor($object)
    {
        $isVendor = $object->getAfterLoadIsVendor();
        if ($isVendor !== null) {
            $object->setIsVendor($isVendor);
            return $this;
        }
        $object->setIsVendor($this->getIsVendor($object));
        return $this;
    }
    
    /**
     * Delete is vendor
     * 
     * @param \Magento\Framework\Model\AbstractModel|\Magento\Framework\DataObject $object
     * @return $this
     */
    public function deleteIsVendor($object)
    {
        $connection = $this->getConnection();
        $id = (int) $object->getId();
        if (empty($id)) {
            return $this;
        }
        $connection->delete($this->getTable($this->isVendorTable), [$this->getIdFieldName().' = ?' => $id]);
        return $this;
    }
    
    /**
     * Save is vendor
     * 
     * @param \Magento\Framework\Model\AbstractModel|\Magento\Framework\DataObject $object
     * @return $this
     */
    public function saveIsVendor($object)
    {
        $connection = $this->getConnection();
        $id = (int) $object->getId();
        if (empty($id)) {
            return $this;
        }
        $isVendor = $object->getIsVendor();
        if (empty($isVendor)) {
            $this->deleteIsVendor($object);
            return $this;
        }
        $oldIsVendor = $this->getIsVendor($object);
        if (empty($oldIsVendor)) {
            $connection->insert($this->getTable($this->isVendorTable), [$this->getIdFieldName() => $id, 'is_vendor' => $isVendor]);
            return $this;
        }
        if ($oldIsVendor !== $isVendor) {
            $connection->update($this->getTable($this->isVendorTable), ['is_vendor' => $isVendor], [$this->getIdFieldName().' = ?' => $id]);
            return $this;
        }
        return $this;
    }
    
}