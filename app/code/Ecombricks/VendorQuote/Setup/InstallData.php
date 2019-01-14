<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Setup;

/**
 * Install data
 */
class InstallData implements \Magento\Framework\Setup\InstallDataInterface
{
    
    /**
     * Create vendor quote data
     * 
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
     * @return $this
     */
    protected function createVendorQuoteData(\Magento\Framework\Setup\ModuleDataSetupInterface $setup)
    {
        $connection = $setup->getConnection();
        $connection->query(
            $connection->insertFromSelect(
                $connection->select()->from($setup->getTable('quote'), [])->columns([
                    'entity_id' => 'entity_id',
                    'vendor_id' => new \Zend_Db_Expr(\Ecombricks\Vendor\Model\Vendor::DEFAULT_ID)
                ]),
                $setup->getTable('ecombricks_vendor_quote'),
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
     * Install
     * 
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     * @return void
     */
    public function install(\Magento\Framework\Setup\ModuleDataSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $setup->startSetup();
        $this->createVendorQuoteData($setup);
        $setup->endSetup();
    }
    
}