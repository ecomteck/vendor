<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Model\ResourceModel;

/**
 * Vendor resource model
 */
class Vendor extends \Ecombricks\Framework\Model\ResourceModel\Db\AbstractDb
{
    
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('ecombricks_vendor_vendor', 'vendor_id');
    }
    
    /**
     * Get id by code
     * 
     * @param string $code
     * @return mixed
     */
    public function getIdByCode($code)
    {
        return $this->getIdByField('code', $code);
    }
    
    /**
     * Get id by name
     * 
     * @param string $name
     * @return mixed
     */
    public function getIdByName($name)
    {
        return $this->getIdByField('name', $name);
    }
    
    /**
     * Delete related entities
     * 
     * @param \Magento\Framework\Model\AbstractModel $object
     * @param string $tableName
     * @return $this
     */
    public function deleteRelatedEntities(\Magento\Framework\Model\AbstractModel $object, $tableName)
    {
        $connection = $this->getConnection();
        $bind = ['vendor_id' => \Ecombricks\Vendor\Model\Vendor::DEFAULT_ID];
        $where = $connection->quoteIdentifier('vendor_id').' = '.$connection->quote($object->getId());
        $connection->update($this->getTable($tableName), $bind, $where);
        return $this;
    }
    
}