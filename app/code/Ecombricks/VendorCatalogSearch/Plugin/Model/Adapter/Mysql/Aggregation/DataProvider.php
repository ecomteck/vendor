<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCatalogSearch\Plugin\Model\Adapter\Mysql\Aggregation;

/**
 * Catalog search aggregation data provider model plugin
 */
class DataProvider
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
     * Around get data set
     * 
     * @param \Magento\CatalogSearch\Model\Adapter\Mysql\Aggregation\DataProvider $subject
     * @param \Closure $proceed
     * @param \Magento\Framework\Search\Request\BucketInterface $bucket
     * @param \Magento\Framework\Search\Request\Dimension[] $dimensions
     * @param \Magento\Framework\DB\Ddl\Table $entityIdsTable
     * @return \Magento\Framework\DB\Select
     */
    public function aroundGetDataSet(
        \Magento\CatalogSearch\Model\Adapter\Mysql\Aggregation\DataProvider $subject,
        \Closure $proceed,
        \Magento\Framework\Search\Request\BucketInterface $bucket,
        array $dimensions,
        \Magento\Framework\DB\Ddl\Table $entityIdsTable
    )
    {
        if ($bucket->getField() == 'vendor_id') {
            $connection = $this->resource->getConnection();
            $derivedTable = $connection->select();
            $derivedTable->from(['main_table' => $this->resource->getTableName('ecombricks_vendor_catalog_product_entity')], ['value' => 'vendor_id']);
            $derivedTable->joinInner(['entities' => $entityIdsTable->getName()], 'main_table.entity_id = entities.entity_id', []);
            $select = $connection->select();
            $select->from(['main_table' => $derivedTable]);
            return $select;
        }
        return $proceed($bucket, $dimensions, $entityIdsTable);
    }
    
}