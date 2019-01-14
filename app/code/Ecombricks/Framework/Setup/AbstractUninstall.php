<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Setup;

/**
 * Uninstall
 */
abstract class AbstractUninstall implements \Magento\Framework\Setup\UninstallInterface
{
    
    /**
     * Drop table
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param string $tableName
     * @return $this
     */
    protected function dropTable(\Magento\Framework\Setup\SchemaSetupInterface $setup, $tableName)
    {
        $connection = $setup->getConnection();
        if (!$connection->isTableExists($setup->getTable($tableName))) {
            return $this;
        }
        $connection->dropTable($setup->getTable($tableName));
        return $this;
    }
    
    /**
     * Drop column
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param string $tableName
     * @param string $columnName
     * @return $this
     */
    protected function dropColumn(\Magento\Framework\Setup\SchemaSetupInterface $setup, $tableName, $columnName)
    {
        $connection = $setup->getConnection();
        if (!$connection->tableColumnExists($tableName, $columnName)) {
            return $this;
        }
        foreach ($connection->getForeignKeys($setup->getTable($tableName)) as $foreignKey) {
            if ($foreignKey['COLUMN_NAME'] !== $columnName) {
                continue;
            }
            $connection->dropForeignKey($setup->getTable($tableName), $foreignKey['FK_NAME']);
        }
        $connection->dropColumn($setup->getTable($tableName), $columnName);
        return $this;
    }
    
    /**
     * Drop vendor column
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param string $tableName
     * @return $this
     */
    protected function dropVendorColumn(\Magento\Framework\Setup\SchemaSetupInterface $setup, $tableName)
    {
        $this->dropColumn($setup, $tableName, 'vendor_id');
        return $this;
    }
    
}