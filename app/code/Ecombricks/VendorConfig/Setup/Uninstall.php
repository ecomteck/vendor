<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorConfig\Setup;

/**
 * Uninstall
 */
class Uninstall extends \Ecombricks\Framework\Setup\AbstractUninstall
{
    
    /**
     * Drop vendor core config data table
     * 
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @return $this
     */
    protected function dropVendorCoreConfigDataTable(\Magento\Framework\Setup\SchemaSetupInterface $setup)
    {
        $this->dropTable($setup, 'ecombricks_vendor_core_config_data');
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
        $this->dropVendorCoreConfigDataTable($setup);
    }
    
}