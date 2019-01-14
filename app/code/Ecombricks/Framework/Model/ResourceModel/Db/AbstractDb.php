<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Model\ResourceModel\Db;

/**
 * Abstract resource model
 */
abstract class AbstractDb extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    
    /**
     * Get id by field
     * 
     * @param string $field
     * @param mixed $value
     * @return mixed
     */
    public function getIdByField($field, $value)
    {
        $connection = $this->getConnection();
        $select = $connection->select()
            ->from($this->getMainTable(), [ $this->getIdFieldName() ])
            ->where($connection->quoteIdentifier($field).' = ?', $value);
        $id = $connection->fetchOne($select);
        return (!empty($id)) ? $id : null;
    }
    
}