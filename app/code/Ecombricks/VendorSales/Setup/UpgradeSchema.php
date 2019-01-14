<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Setup;

/**
 * Upgrade schema
 */
class UpgradeSchema extends \Ecombricks\Framework\Setup\AbstractUpgradeSchema
{
    
    /**
     * Create vendor sales payment transaction table
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     * @return $this
     */
    protected function createVendorSalesPaymentTransactionTable(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $connection = $setup->getConnection();
        $tableName = 'ecombricks_vendor_sales_payment_transaction';
        $table = $connection->newTable($setup->getTable($tableName))
            ->addColumn(
                'transaction_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Transaction ID'
            )
            ->addColumn(
                'vendor_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Vendor ID'
            )
            ->addIndex(
                $setup->getIdxName($tableName, ['transaction_id'], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE),
                ['transaction_id'],
                ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
            )
            ->addIndex(
                $setup->getIdxName($tableName, ['vendor_id']),
                ['vendor_id']
            )
            ->addForeignKey(
                $setup->getFkName($tableName, 'transaction_id', 'sales_payment_transaction', 'transaction_id'),
                'transaction_id',
                $setup->getTable('sales_payment_transaction'),
                'transaction_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->addForeignKey(
                $setup->getFkName($tableName, 'vendor_id', 'ecombricks_vendor_vendor', 'vendor_id'),
                'vendor_id',
                $setup->getTable('ecombricks_vendor_vendor'),
                'vendor_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->setComment('Vendor Sales Payment Transaction');
        $this->createTable($setup, $table);
        return $this;
    }
    
    /**
     * Upgrade
     *
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     * @return void
     */
    public function upgrade(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $setup->startSetup();
        if ($this->isVersionLess($context, '2.1.0')) {
            $this->createVendorSalesPaymentTransactionTable($setup, $context);
        }
        $setup->endSetup();
    }
    
}