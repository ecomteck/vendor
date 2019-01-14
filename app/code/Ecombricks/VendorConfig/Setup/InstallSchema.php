<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorConfig\Setup;

/**
 * Install schema
 */
class InstallSchema extends \Ecombricks\Framework\Setup\AbstractInstallSchema
{
    
    /**
     * Cache frontend pool
     *
     * @var \Magento\Framework\App\Cache\Frontend\Pool
     */
    protected $cacheFrontendPool;
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool
     * @return void
     */
    public function __construct(
        \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool
    )
    {
        $this->cacheFrontendPool = $cacheFrontendPool;
    }
    
    /**
     * Flush cache
     * 
     * @return $this
     */
    protected function flushCache()
    {
        foreach ($this->cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }
        return $this;
    }
    
    /**
     * Create vendor core config data table
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function createVendorCoreConfigDataTable(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $connection = $setup->getConnection();
        $tableName = 'ecombricks_vendor_core_config_data';
        $table = $connection
            ->newTable($setup->getTable($tableName))
            ->addColumn(
                'config_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Config Id'
            )
            ->addColumn(
                'vendor_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Vendor Id'
            )
            ->addColumn(
                'scope',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                8,
                ['nullable' => false, 'default' => 'default'],
                'Config Scope'
            )
            ->addColumn(
                'scope_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'default' => '0'],
                'Config Scope Id'
            )
            ->addColumn(
                'path',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'default' => 'general'],
                'Config Path'
            )
            ->addColumn(
                'value',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '64k',
                [],
                'Config Value'
            )
            ->addIndex(
                $setup->getIdxName($tableName, ['vendor_id', 'scope', 'scope_id', 'path'], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE),
                ['vendor_id', 'scope', 'scope_id', 'path'],
                ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
            )
            ->addForeignKey(
                $setup->getFkName($tableName, 'vendor_id', 'ecombricks_vendor_vendor', 'vendor_id'),
                'vendor_id',
                $setup->getTable('ecombricks_vendor_vendor'),
                'vendor_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->setComment('Vendor Config Data');
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
        $this->createVendorCoreConfigDataTable($setup);
        $this->flushCache();
        $setup->endSetup();
    }
    
}