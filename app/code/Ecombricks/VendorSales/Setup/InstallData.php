<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Setup;

/**
 * Install data
 */
class InstallData implements \Magento\Framework\Setup\InstallDataInterface
{
    
    /**
     * Create vendor sales order data
     * 
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
     * @return $this
     */
    protected function createVendorSalesOrderData(\Magento\Framework\Setup\ModuleDataSetupInterface $setup)
    {
        $connection = $setup->getConnection();
        $connection->query(
            $connection->insertFromSelect(
                $connection->select()->from($setup->getTable('sales_order'), [])->columns([
                    'entity_id' => 'entity_id',
                    'vendor_id' => new \Zend_Db_Expr(\Ecombricks\Vendor\Model\Vendor::DEFAULT_ID)
                ]),
                $setup->getTable('ecombricks_vendor_sales_order'),
                [
                    'entity_id',
                    'vendor_id'
                ],
                \Magento\Framework\DB\Adapter\AdapterInterface::INSERT_ON_DUPLICATE
            )
        );
        return $this;
    }
    
    /**
     * Update sales order grid data
     * 
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
     * @return $this
     */
    protected function updateSalesOrderGridData(\Magento\Framework\Setup\ModuleDataSetupInterface $setup)
    {
        $connection = $setup->getConnection();
        $connection->update($setup->getTable('sales_order_grid'), ['vendor_id' => new \Zend_Db_Expr(\Ecombricks\Vendor\Model\Vendor::DEFAULT_ID)]);
        return $this;
    }
    
    /**
     * Create vendor sales shipment data
     * 
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
     * @return $this
     */
    protected function createVendorSalesShipmentData(\Magento\Framework\Setup\ModuleDataSetupInterface $setup)
    {
        $connection = $setup->getConnection();
        $connection->query(
            $connection->insertFromSelect(
                $connection->select()->from($setup->getTable('sales_shipment'), [])->columns([
                    'entity_id' => 'entity_id',
                    'vendor_id' => new \Zend_Db_Expr(\Ecombricks\Vendor\Model\Vendor::DEFAULT_ID)
                ]),
                $setup->getTable('ecombricks_vendor_sales_shipment'),
                [
                    'entity_id',
                    'vendor_id'
                ],
                \Magento\Framework\DB\Adapter\AdapterInterface::INSERT_ON_DUPLICATE
            )
        );
        return $this;
    }
    
    /**
     * Update sales shipment grid data
     * 
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
     * @return $this
     */
    protected function updateSalesShipmentGridData(\Magento\Framework\Setup\ModuleDataSetupInterface $setup)
    {
        $connection = $setup->getConnection();
        $connection->update($setup->getTable('sales_shipment_grid'), ['vendor_id' => new \Zend_Db_Expr(\Ecombricks\Vendor\Model\Vendor::DEFAULT_ID)]);
        return $this;
    }
    
    /**
     * Create vendor sales invoice data
     * 
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
     * @return $this
     */
    protected function createVendorSalesInvoiceData(\Magento\Framework\Setup\ModuleDataSetupInterface $setup)
    {
        $connection = $setup->getConnection();
        $connection->query(
            $connection->insertFromSelect(
                $connection->select()->from($setup->getTable('sales_invoice'), [])->columns([
                    'entity_id' => 'entity_id',
                    'vendor_id' => new \Zend_Db_Expr(\Ecombricks\Vendor\Model\Vendor::DEFAULT_ID)
                ]),
                $setup->getTable('ecombricks_vendor_sales_invoice'),
                [
                    'entity_id',
                    'vendor_id'
                ],
                \Magento\Framework\DB\Adapter\AdapterInterface::INSERT_ON_DUPLICATE
            )
        );
        return $this;
    }
    
    /**
     * Update sales invoice grid data
     * 
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
     * @return $this
     */
    protected function updateSalesInvoiceGridData(\Magento\Framework\Setup\ModuleDataSetupInterface $setup)
    {
        $connection = $setup->getConnection();
        $connection->update($setup->getTable('sales_invoice_grid'), ['vendor_id' => new \Zend_Db_Expr(\Ecombricks\Vendor\Model\Vendor::DEFAULT_ID)]);
        return $this;
    }
    
    /**
     * Create vendor sales creditmemo data
     * 
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
     * @return $this
     */
    protected function createVendorSalesCreditmemoData(\Magento\Framework\Setup\ModuleDataSetupInterface $setup)
    {
        $connection = $setup->getConnection();
        $connection->query(
            $connection->insertFromSelect(
                $connection->select()->from($setup->getTable('sales_creditmemo'), [])->columns([
                    'entity_id' => 'entity_id',
                    'vendor_id' => new \Zend_Db_Expr(\Ecombricks\Vendor\Model\Vendor::DEFAULT_ID)
                ]),
                $setup->getTable('ecombricks_vendor_sales_creditmemo'),
                [
                    'entity_id',
                    'vendor_id'
                ],
                \Magento\Framework\DB\Adapter\AdapterInterface::INSERT_ON_DUPLICATE
            )
        );
        return $this;
    }
    
    /**
     * Update sales creditmemo grid data
     * 
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
     * @return $this
     */
    protected function updateSalesCreditmemoGridData(\Magento\Framework\Setup\ModuleDataSetupInterface $setup)
    {
        $connection = $setup->getConnection();
        $connection->update($setup->getTable('sales_creditmemo_grid'), ['vendor_id' => new \Zend_Db_Expr(\Ecombricks\Vendor\Model\Vendor::DEFAULT_ID)]);
        return $this;
    }
    
    /**
     * Install
     * 
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     * @return void
     */
    public function install(\Magento\Framework\Setup\ModuleDataSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $setup->startSetup();
        $this->createVendorSalesOrderData($setup);
        $this->updateSalesOrderGridData($setup);
        $this->createVendorSalesShipmentData($setup);
        $this->updateSalesShipmentGridData($setup);
        $this->createVendorSalesInvoiceData($setup);
        $this->updateSalesInvoiceGridData($setup);
        $this->createVendorSalesCreditmemoData($setup);
        $this->updateSalesCreditmemoGridData($setup);
        $setup->endSetup();
    }
    
}