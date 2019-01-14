<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorConfig\Model\ResourceModel\Config;

/**
 * Config data resource model
 */
class Data extends \Magento\Config\Model\ResourceModel\Config\Data
{
    
    /**
     * Check unique
     * 
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     */
    protected function _checkUnique(\Magento\Framework\Model\AbstractModel $object)
    {
        $connection = $this->getConnection();
        $select = $connection->select()
            ->from($this->getMainTable(), [$this->getIdFieldName()])
            ->where('scope = :scope')
            ->where('scope_id = :scope_id')
            ->where('path = :path');
        $bind = [
            'scope' => $object->getScope(),
            'scope_id' => $object->getScopeId(),
            'path' => $object->getPath(),
        ];
        $vendorId = $object->getVendorId();
        if ($vendorId) {
            $select->where('vendor_id = :vendor_id');
            $bind['vendor_id'] = $vendorId;
        }
        $configId = $connection->fetchOne($select, $bind);
        if ($configId) {
            $object->setId($configId);
        }
        return $this;
    }

    /**
     * Clear scope data
     *
     * @param string $scopeCode
     * @param int|array $scopeIds
     * @return $this
     */
    public function clearScopeData($scopeCode, $scopeIds)
    {
        if (!is_array($scopeIds)) {
            $scopeIds = [$scopeIds];
        }
        $connection = $this->getConnection();
        $where = [ 'scope = ?' => $scopeCode, 'scope_id IN (?)' => $scopeIds ];
        $connection->delete('core_config_data', $where);
        $connection->delete('ecombricks_vendor_core_config_data', $where);
        return $this;
    }
    
}