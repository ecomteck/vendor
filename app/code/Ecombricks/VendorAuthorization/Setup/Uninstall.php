<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorAuthorization\Setup;

/**
 * Uninstall
 */
class Uninstall extends \Ecombricks\Framework\Setup\AbstractUninstall
{
    
    /**
     * Drop vendor authorization role table
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function dropVendorAuthorizationRoleTable(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $this->dropTable($setup, 'ecombricks_vendor_authorization_role');
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
        $this->dropVendorAuthorizationRoleTable($setup);
    }
    
}