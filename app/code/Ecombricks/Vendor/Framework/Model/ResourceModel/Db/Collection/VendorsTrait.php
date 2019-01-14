<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Framework\Model\ResourceModel\Db\Collection;

/**
 * Collection vendors trait
 */
trait VendorsTrait
{
    
    /**
     * Vendor IDs loaded
     *
     * @var bool
     */
    protected $vendorIdsLoaded = false;
    
    /**
     * Get vendor IDs data
     * 
     * @return array
     */
    public function getVendorIdsData()
    {
        $vendorIds = [];
        $ids = [];
        foreach ($this->_items as $object) {
            $ids[] = (int) $object->getId();
        }
        if (empty($ids)) {
            return $vendorIds;
        }
        $connection = $this->getConnection();
        $resource = $this->getResource();
        $idFieldName = $resource->getIdFieldName();
        $select = $connection->select()
            ->from($resource->getTable($this->vendorIdsTable))
            ->where($idFieldName.' IN (?)', $ids);
        $rows = $connection->fetchAll($select);
        if (!empty($rows)) {
            foreach ($rows as $row) {
                $id = (int) $row[$idFieldName];
                if (!isset($vendorIds[$id])) {
                    $vendorIds[$id] = [];
                }
                $vendorIds[$id][] = (int) $row['vendor_id'];
            }
        }
        return $vendorIds;
    }
    
    /**
     * Load vendor IDs
     * 
     * @return $this
     */
    public function loadVendorIdsData()
    {
        if ($this->vendorIdsLoaded) {
            return $this;
        }
        $vendorIds = $this->getVendorIdsData();
        foreach ($this->_items as $item) {
            $id = (int) $item->getId();
            $item->setVendorIds(!empty($vendorIds[$id]) ? $vendorIds[$id] : []);
        }
        $this->vendorIdsLoaded = true;
        return $this;
    }
    
    /**
     * After load
     * 
     * @return $this
     */
    public function vendorsAfterLoad()
    {
        $this->loadVendorIdsData();
        return $this;
    }
    
}