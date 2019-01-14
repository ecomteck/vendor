<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Setup;

/**
 * Upgrade schema
 */
abstract class AbstractUpgradeSchema implements \Magento\Framework\Setup\UpgradeSchemaInterface
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
     * Compare version
     * 
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     * @param string $version
     * @param string $operator
     * @return mixed
     */
    protected function compareVersion(\Magento\Framework\Setup\ModuleContextInterface $context, $version, $operator)
    {
        return version_compare($context->getVersion(), $version, $operator);
    }
    
    /**
     * Check if version is less
     * 
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     * @param string $version
     * @return mixed
     */
    protected function isVersionLess(\Magento\Framework\Setup\ModuleContextInterface $context, $version)
    {
        return $this->compareVersion($context, $version, '<');
    }
    
}