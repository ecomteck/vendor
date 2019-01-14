<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Framework\Model\ResourceModel\Db;

/**
 * Model resource vendors trait
 */
trait VendorsTrait
{
    
    /**
     * Get vendor IDs
     * 
     * @param \Magento\Framework\Model\AbstractModel|\Magento\Framework\DataObject $object
     * @return array
     */
    public function getVendorIds($object)
    {
        $connection = $this->getConnection();
        $id = (int) $object->getId();
        if (empty($id)) {
            return null;
        }
        $select = $connection->select()
            ->from($this->getTable($this->vendorIdsTable), ['vendor_id'])
            ->where($this->getIdFieldName().' = ?', $id);
        $vendorIds = $connection->fetchCol($select);
        return (!empty($vendorIds)) ? $vendorIds : [];
    }
    
    /**
     * Load vendor IDs
     * 
     * @param \Magento\Framework\Model\AbstractModel|\Magento\Framework\DataObject $object
     * @return $this
     */
    public function loadVendorIds($object)
    {
        $object->setVendorIds($this->getVendorIds($object));
        return $this;
    }
    
    /**
     * Delete vendor IDs
     * 
     * @param \Magento\Framework\Model\AbstractModel|\Magento\Framework\DataObject $object
     * @return $this
     */
    public function deleteVendorIds($object)
    {
        $connection = $this->getConnection();
        $id = (int) $object->getId();
        if (empty($id)) {
            return $this;
        }
        $connection->delete($this->getTable($this->vendorIdsTable), [$this->getIdFieldName().' = ?' => $id]);
        return $this;
    }
    
    /**
     * Save vendor IDs
     * 
     * @param \Magento\Framework\Model\AbstractModel|\Magento\Framework\DataObject $object
     * @return $this
     */
    public function saveVendorIds($object)
    {
        $connection = $this->getConnection();
        $id = (int) $object->getId();
        if (empty($id)) {
            return $this;
        }
        $vendorIds = $object->getVendorIds();
        if (empty($vendorIds)) {
            $this->deleteVendorIds($object);
            return $this;
        }
        $oldVendorIds = $this->getVendorIds($object);
        $vendorIdsToDelete = array_diff($oldVendorIds, $vendorIds);
        $vendorIdsToInsert = array_diff($vendorIds, $oldVendorIds);
        if (!empty($vendorIdsToDelete)) {
            $connection->delete(
                $this->getTable($this->vendorIdsTable),
                [$this->getIdFieldName().' = ?' => $id, 'vendor_id IN (?)' => $vendorIdsToDelete]
            );
        }
        if (!empty($vendorIdsToInsert)) {
            $data = [];
            foreach ($vendorIdsToInsert as $vendorId) {
                $data[] = [$this->getIdFieldName() => $id, 'vendor_id' => $vendorId];
            }
            $connection->insertMultiple($this->getTable($this->vendorIdsTable), $data);
        }
        return $this;
    }
    
}