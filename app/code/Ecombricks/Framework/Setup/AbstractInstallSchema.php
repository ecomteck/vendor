<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Setup;

/**
 * Install schema
 */
abstract class AbstractInstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    
    /**
     * Create table
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param \Magento\Framework\DB\Ddl\Table $table
     * @return $this
     */
    protected function createTable(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\DB\Ddl\Table $table)
    {
        $connection = $setup->getConnection();
        if ($connection->isTableExists($table->getName())) {
            return $this;
        }
        $connection->createTable($table);
        return $this;
    }
    
    /**
     * Create column
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param string $tableName
     * @param string $columnName
     * @param array $definition
     * @return $this
     */
    protected function createColumn(\Magento\Framework\Setup\SchemaSetupInterface $setup, $tableName, $columnName, $definition)
    {
        $connection = $setup->getConnection();
        if ($connection->tableColumnExists($tableName, $columnName)) {
            return $this;
        }
        $connection->addColumn($setup->getTable($tableName), $columnName, $definition);
        return $this;
    }
    
    /**
     * Create vendor column
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param string $tableName
     * @param string $columnName
     * @param string|null $after
     * @return $this
     */
    protected function createVendorColumn(\Magento\Framework\Setup\SchemaSetupInterface $setup, $tableName, $after = null)
    {
        $connection = $setup->getConnection();
        $columnName = 'vendor_id';
        if ($connection->tableColumnExists($tableName, $columnName)) {
            return $this;
        }
        $definition = [
            'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            'unsigned' => true,
            'nullable' => true,
            'comment' => 'Vendor ID'
        ];
        if ($after) {
            $definition['after'] = $after;
        }
        $this->createColumn($setup, $tableName, $columnName, $definition);
        $connection->addForeignKey(
            $setup->getFkName($tableName, $columnName, 'ecombricks_vendor_vendor', $columnName),
            $setup->getTable($tableName),
            $columnName,
            $setup->getTable('ecombricks_vendor_vendor'),
            $columnName,
            \Magento\Framework\DB\Adapter\AdapterInterface::FK_ACTION_CASCADE
        );
        return $this;
    }
    
}