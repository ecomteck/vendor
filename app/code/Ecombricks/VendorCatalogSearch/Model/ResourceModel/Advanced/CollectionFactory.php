<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCatalogSearch\Model\ResourceModel\Advanced;

/**
 * Catalog search advanced collection factory
 */
class CollectionFactory extends \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
{
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     * @return void
     */
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager, 
        $instanceName = \Magento\CatalogSearch\Model\ResourceModel\Advanced\Collection::class
    )
    {
        parent::__construct($objectManager, $instanceName);
    }
    
}