<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Setup;

/**
 * Uninstall
 */
class Uninstall extends \Ecombricks\Framework\Setup\AbstractUninstall
{
    
    /**
     * Drop vendor sales payment transaction table
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function dropVendorSalesPaymentTransactionTable(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $this->dropTable($setup, 'ecombricks_vendor_sales_payment_transaction');
        return $this;
    }
    
    /**
     * Drop sales creditmemo grid vendor column
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function dropSalesCreditmemoGridVendorColumn(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $this->dropVendorColumn($setup, 'sales_creditmemo_grid');
        return $this;
    }
    
    /**
     * Drop vendor sales creditmemo table
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function dropVendorSalesCreditmemoTable(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $this->dropTable($setup, 'ecombricks_vendor_sales_creditmemo');
        return $this;
    }
    
    /**
     * Drop sales invoice grid vendor column
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function dropSalesInvoiceGridVendorColumn(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $this->dropVendorColumn($setup, 'sales_invoice_grid');
        return $this;
    }
    
    /**
     * Drop vendor sales invoice table
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function dropVendorSalesInvoiceTable(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $this->dropTable($setup, 'ecombricks_vendor_sales_invoice');
        return $this;
    }
    
    /**
     * Drop sales shipment grid vendor column
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function dropSalesShipmentGridVendorColumn(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $this->dropVendorColumn($setup, 'sales_shipment_grid');
        return $this;
    }
    
    /**
     * Drop vendor sales shipment table
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function dropVendorSalesShipmentTable(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $this->dropTable($setup, 'ecombricks_vendor_sales_shipment');
        return $this;
    }
    
    /**
     * Drop sales order grid vendor column
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function dropSalesOrderGridVendorColumn(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $this->dropVendorColumn($setup, 'sales_order_grid');
        return $this;
    }
    
    /**
     * Drop vendor sales order table
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function dropVendorSalesOrderTable(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $this->dropTable($setup, 'ecombricks_vendor_sales_order');
        return $this;
    }
    
    /**
     * Uninstall
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     * @return void
     */
    public function uninstall(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $this->dropVendorSalesPaymentTransactionTable($setup);
        $this->dropSalesCreditmemoGridVendorColumn($setup);
        $this->dropVendorSalesCreditmemoTable($setup);
        $this->dropSalesInvoiceGridVendorColumn($setup);
        $this->dropVendorSalesInvoiceTable($setup);
        $this->dropSalesShipmentGridVendorColumn($setup);
        $this->dropVendorSalesShipmentTable($setup);
        $this->dropSalesOrderGridVendorColumn($setup);
        $this->dropVendorSalesOrderTable($setup);
    }
    
}