<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Setup;

/**
 * Install schema
 */
class InstallSchema extends \Ecombricks\Framework\Setup\AbstractInstallSchema
{
    
    /**
     * Create vendor quote table
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function createVendorQuoteTable(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $connection = $setup->getConnection();
        $tableName = 'ecombricks_vendor_quote';
        $table = $connection
            ->newTable($setup->getTable($tableName))
            ->addColumn(
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Entity ID'
            )
            ->addColumn(
                'vendor_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Vendor ID'
            )
            ->addIndex(
                $setup->getIdxName($tableName, ['entity_id'], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE),
                ['entity_id'],
                ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
            )
            ->addForeignKey(
                $setup->getFkName($tableName, 'entity_id', 'quote', 'entity_id'),
                'entity_id',
                $setup->getTable('quote'),
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->addForeignKey(
                $setup->getFkName($tableName, 'vendor_id', 'ecombricks_vendor_vendor', 'vendor_id'),
                'vendor_id',
                $setup->getTable('ecombricks_vendor_vendor'),
                'vendor_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->setComment('Vendor Quote');
        $this->createTable($setup, $table);
        return $this;
    }
    
    /**
     * Install
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     * @return void
     */
    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $setup->startSetup();
        $this->createVendorQuoteTable($setup);
        $setup->endSetup();
    }
    
}