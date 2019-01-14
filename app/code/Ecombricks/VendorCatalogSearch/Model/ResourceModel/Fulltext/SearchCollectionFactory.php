<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCatalogSearch\Model\ResourceModel\Fulltext;

/**
 * Catalog search full text search collection factory
 */
class SearchCollectionFactory extends \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
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
        $instanceName = \Ecombricks\VendorCatalogSearch\Model\ResourceModel\Fulltext\SearchCollection::class
    )
    {
        parent::__construct($objectManager, $instanceName);
    }
    
}