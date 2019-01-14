<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Setup;

/**
 * Install data
 */
class InstallData implements \Magento\Framework\Setup\InstallDataInterface
{
    
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
        $connection = $setup->getConnection();
        
        $connection->insert($setup->getTable('ecombricks_vendor_vendor'), [
            'vendor_id' => \Ecombricks\Vendor\Model\Vendor::DEFAULT_ID,
            'code' => 'default',
            'name' => 'Default',
            'is_active' => 1
        ]);
        
        $setup->endSetup();
    }
    
}