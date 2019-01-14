<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorUser\Setup;

/**
 * Uninstall
 */
class Uninstall extends \Ecombricks\Framework\Setup\AbstractUninstall
{
    
    /**
     * Drop vendor admin user vendor table
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function dropVendorAdminUserVendorTable(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $this->dropTable($setup, 'ecombricks_vendor_admin_user_vendor');
        return $this;
    }
    
    /**
     * Drop vendor admin user table
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function dropVendorAdminUserTable(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $this->dropTable($setup, 'ecombricks_vendor_admin_user');
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
        $this->dropVendorAdminUserVendorTable($setup);
        $this->dropVendorAdminUserTable($setup);
    }
    
}