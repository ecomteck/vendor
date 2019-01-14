<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorAuthorization\Setup;

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
     * Create vendor authorization role table
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function createVendorAuthorizationRoleTable(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $connection = $setup->getConnection();
        $tableName = 'ecombricks_vendor_authorization_role';
        $table = $connection
            ->newTable($setup->getTable($tableName))
            ->addColumn(
                'role_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Role ID'
            )
            ->addColumn(
                'is_vendor',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => '1'],
                'Is Vendor'
            )
            ->addIndex(
                $setup->getIdxName($tableName, ['role_id'], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE),
                ['role_id'],
                ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
            )
            ->addForeignKey(
                $setup->getFkName($tableName, 'role_id', 'authorization_role', 'role_id'),
                'role_id',
                $setup->getTable('authorization_role'),
                'role_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->setComment('Vendor Authorization Role');
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
        $this->createVendorAuthorizationRoleTable($setup);
        $this->flushCache();
        $setup->endSetup();
    }
    
}