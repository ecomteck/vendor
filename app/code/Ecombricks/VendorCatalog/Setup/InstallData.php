<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCatalog\Setup;

/**
 * Install data
 */
class InstallData implements \Magento\Framework\Setup\InstallDataInterface
{
    
    /**
     * Create vendor catalog product entity data
     * 
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
     * @return $this
     */
    protected function createVendorCatalogProductEntityData(\Magento\Framework\Setup\ModuleDataSetupInterface $setup)
    {
        $connection = $setup->getConnection();
        $connection->query(
            $connection->insertFromSelect(
                $connection->select()->from($setup->getTable('catalog_product_entity'), [])->columns([
                    'entity_id' => 'entity_id',
                    'vendor_id' => new \Zend_Db_Expr(\Ecombricks\Vendor\Model\Vendor::DEFAULT_ID)
                ]),
                $setup->getTable('ecombricks_vendor_catalog_product_entity'),
                ['entity_id', 'vendor_id'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INSERT_ON_DUPLICATE
            )
        );
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
        $this->createVendorCatalogProductEntityData($setup);
        $setup->endSetup();
    }
    
}