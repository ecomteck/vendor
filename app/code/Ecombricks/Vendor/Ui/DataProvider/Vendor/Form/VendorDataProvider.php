<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Ui\DataProvider\Vendor\Form;

/**
 * Vendor form data provider
 */
class VendorDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    
    /**
     * Pool
     * 
     * @var \Magento\Ui\DataProvider\Modifier\PoolInterface
     */
    protected $pool;

    /**
     * Constructor
     * 
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param \Ecombricks\Vendor\Model\ResourceModel\Vendor\CollectionFactory $collectionFactory
     * @param \Magento\Ui\DataProvider\Modifier\PoolInterface $pool
     * @param array $meta
     * @param array $data
     * @return void
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Ecombricks\Vendor\Model\ResourceModel\Vendor\CollectionFactory $collectionFactory,
        \Magento\Ui\DataProvider\Modifier\PoolInterface $pool,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $collectionFactory->create();
        $this->pool = $pool;
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
    }
    
    /**
     * Get data
     * 
     * @return array
     */
    public function getData()
    {
        foreach ($this->pool->getModifiersInstances() as $modifier) {
            $this->data = $modifier->modifyData($this->data);
        }
        return $this->data;
    }
    
    /**
     * Get meta
     * 
     * @return array
     */
    public function getMeta()
    {
        $meta = parent::getMeta();
        foreach ($this->pool->getModifiersInstances() as $modifier) {
            $meta = $modifier->modifyMeta($meta);
        }
        return $meta;
    }
    
}