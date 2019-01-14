<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Setup;

/**
 * Install schema
 */
class InstallSchema extends \Ecombricks\Framework\Setup\AbstractInstallSchema
{
    
    /**
     * Create vendor table
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function createVendorTable(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $connection = $setup->getConnection();
        $tableName = 'ecombricks_vendor_vendor';
        $table = $connection
            ->newTable($setup->getTable($tableName))
            ->addColumn(
                'vendor_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Vendor Id'
            )
            ->addColumn(
                'code',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                32,
                ['nullable' => false],
                'Code'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                64,
                ['nullable' => false],
                'Name'
            )
            ->addColumn(
                'short_description',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                65535,
                ['nullable' => true],
                'Short Description'
            )
            ->addColumn(
                'description',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                65535,
                ['nullable' => true],
                'Description'
            )
            ->addColumn(
                'meta_title',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => true],
                'Page Meta Title'
            )
            ->addColumn(
                'meta_keywords',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                65535,
                ['nullable' => true],
                'Page Meta Keywords'
            )
            ->addColumn(
                'meta_description',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                65535,
                ['nullable' => true],
                'Page Meta Description'
            )
            ->addColumn(
                'logo',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => true],
                'Logo'
            )
            ->addColumn(
                'is_active',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['nullable' => false, 'default' => '0'],
                'Is Active'
            )
            ->addColumn(
                'created_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                'Creation Time'
            )
            ->addColumn(
                'updated_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                'Update Time'
            )
            ->addIndex(
                $setup->getIdxName($tableName, ['code'], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE),
                ['code'],
                ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
            )
            ->addIndex(
                $setup->getIdxName($tableName, ['name'], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE),
                ['name'],
                ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
            )
            ->setComment('Vendor');
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
        $this->createVendorTable($setup);
        $setup->endSetup();
    }
    
}