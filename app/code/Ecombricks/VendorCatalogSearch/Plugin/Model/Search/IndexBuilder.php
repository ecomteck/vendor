<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCatalogSearch\Plugin\Model\Search;

/**
 * Catalog search index builder model plugin
 */
class IndexBuilder
{
    
    /**
     * Resource
     * 
     * @var \Magento\Framework\App\ResourceConnection
     */
    protected $resource;

    /**
     * Constructor
     * 
     * @param \Magento\Framework\App\ResourceConnection $resource
     * @return void
     */
    public function __construct(
        \Magento\Framework\App\ResourceConnection $resource
    )
    {
        $this->resource = $resource;
    }
    
    /**
     * Around build
     * 
     * @param \Magento\CatalogSearch\Model\Search\IndexBuilder $subject
     * @param \Closure $proceed
     * @param \Magento\Framework\Search\RequestInterface $request
     * @return \Magento\Framework\DB\Select
     */
    public function aroundBuild(
        \Magento\CatalogSearch\Model\Search\IndexBuilder $subject,
        \Closure $proceed,
        \Magento\Framework\Search\RequestInterface $request
    )
    {
        $result = $proceed($request);
        $result->joinLeft(
            ['vendor_id_index' => $this->resource->getTableName('ecombricks_vendor_catalog_product_entity')],
            'search_index.entity_id = vendor_id_index.entity_id',
            []
        );
        return $result;
    }
    
}