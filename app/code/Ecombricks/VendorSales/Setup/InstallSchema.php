<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Setup;

/**
 * Install schema
 */
class InstallSchema extends \Ecombricks\Framework\Setup\AbstractInstallSchema
{
    
    /**
     * Create vendor sales order table
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function createVendorSalesOrderTable(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $connection = $setup->getConnection();
        $tableName = 'ecombricks_vendor_sales_order';
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
            ->addIndex(
                $setup->getIdxName($tableName, ['vendor_id']),
                ['vendor_id']
            )
            ->addForeignKey(
                $setup->getFkName($tableName, 'entity_id', 'sales_order', 'entity_id'),
                'entity_id',
                $setup->getTable('sales_order'),
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
            ->setComment('Vendor Sales Order');
        $this->createTable($setup, $table);
        return $this;
    }
    
    /**
     * Create sales order grid vendor column
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function createSalesOrderGridVendorColumn(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $this->createVendorColumn($setup, 'sales_order_grid', 'entity_id');
        return $this;
    }
    
    /**
     * Create vendor sales shipment table
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function createVendorSalesShipmentTable(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $connection = $setup->getConnection();
        $tableName = 'ecombricks_vendor_sales_shipment';
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
            ->addIndex(
                $setup->getIdxName($tableName, ['vendor_id']),
                ['vendor_id']
            )
            ->addForeignKey(
                $setup->getFkName($tableName, 'entity_id', 'sales_shipment', 'entity_id'),
                'entity_id',
                $setup->getTable('sales_shipment'),
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
            ->setComment('Vendor Sales Shipment');
        $this->createTable($setup, $table);
        return $this;
    }
    
    /**
     * Create sales shipment grid vendor column
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function createSalesShipmentGridVendorColumn(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $this->createVendorColumn($setup, 'sales_shipment_grid', 'entity_id');
        return $this;
    }
    
    /**
     * Create vendor sales invoice table
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function createVendorSalesInvoiceTable(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $connection = $setup->getConnection();
        $tableName = 'ecombricks_vendor_sales_invoice';
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
            ->addIndex(
                $setup->getIdxName($tableName, ['vendor_id']),
                ['vendor_id']
            )
            ->addForeignKey(
                $setup->getFkName($tableName, 'entity_id', 'sales_invoice', 'entity_id'),
                'entity_id',
                $setup->getTable('sales_invoice'),
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
            ->setComment('Vendor Sales Invoice');
        $this->createTable($setup, $table);
        return $this;
    }
    
    /**
     * Create sales invoice grid vendor column
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function createSalesInvoiceGridVendorColumn(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $this->createVendorColumn($setup, 'sales_invoice_grid', 'entity_id');
        return $this;
    }
    
    /**
     * Create vendor sales creditmemo table
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function createVendorSalesCreditmemoTable(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $connection = $setup->getConnection();
        $tableName = 'ecombricks_vendor_sales_creditmemo';
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
            ->addIndex(
                $setup->getIdxName($tableName, ['vendor_id']),
                ['vendor_id']
            )
            ->addForeignKey(
                $setup->getFkName($tableName, 'entity_id', 'sales_creditmemo', 'entity_id'),
                'entity_id',
                $setup->getTable('sales_creditmemo'),
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
            ->setComment('Vendor Sales Creditmemo');
        $this->createTable($setup, $table);
        return $this;
    }
    
    /**
     * Create sales creditmemo grid vendor column
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function createSalesCreditmemoGridVendorColumn(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $this->createVendorColumn($setup, 'sales_creditmemo_grid', 'entity_id');
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
        $this->createVendorSalesOrderTable($setup);
        $this->createSalesOrderGridVendorColumn($setup);
        $this->createVendorSalesShipmentTable($setup);
        $this->createSalesShipmentGridVendorColumn($setup);
        $this->createVendorSalesInvoiceTable($setup);
        $this->createSalesInvoiceGridVendorColumn($setup);
        $this->createVendorSalesCreditmemoTable($setup);
        $this->createSalesCreditmemoGridVendorColumn($setup);
        $setup->endSetup();
    }
    
}