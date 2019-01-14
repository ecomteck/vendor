<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCatalog\Block\Vendor\Products;

/**
 * Vendor navigation block
 */
class ListProduct extends \Magento\Catalog\Block\Product\ListProduct 
{
    
    use \Ecombricks\Vendor\Block\Vendor\VendorTrait;
    
    /**
     * Registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $registry;
    
    /**
     * Constructor
     * 
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \Magento\Framework\Data\Helper\PostHelper $postDataHelper
     * @param \Magento\Catalog\Model\Layer\Resolver $layerResolver
     * @param \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository
     * @param \Magento\Framework\Url\Helper\Data $urlHelper
     * @param \Magento\Catalog\Model\Layer\Search $catalogLayer
     * @param array $data
     * @return void
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Data\Helper\PostHelper $postDataHelper,
        \Magento\Catalog\Model\Layer\Resolver $layerResolver,
        \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        \Magento\Catalog\Model\Layer\Search $catalogLayer,
        array $data = []
    )
    {
        $this->registry = $context->getRegistry();
        parent::__construct(
            $context,
            $postDataHelper,
            $layerResolver,
            $categoryRepository,
            $urlHelper,
            $data
        );
        $this->_catalogLayer = $catalogLayer;
    }
    
    /**
     * Get product collection
     *
     * @return Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    protected function _getProductCollection()
    {
        if ($this->_productCollection === null) {
            $this->_productCollection = $this->vendorInitializeProductCollection();
        }
        return $this->_productCollection;
    }
    
    /**
     * Initialize product collection
     * 
     * @return Magento\Eav\Model\Entity\Collection\AbstractCollection
     */
    protected function vendorInitializeProductCollection()
    {
        $layer = $this->getLayer();
        $collection = $layer->getProductCollection();
        $collection->addVendorFilter($this->getVendorId());
        $this->prepareSortableFieldsByCategory($layer->getCurrentCategory());
        $toolbar = $this->getToolbarBlock();
        $this->vendorConfigureToolbar($toolbar, $collection);
        $this->_eventManager->dispatch(
            'catalog_block_product_list_collection',
            ['collection' => $collection]
        );
        return $collection;
    }
    
    /**
     * Configure toolbar
     * 
     * @param \Magento\Catalog\Block\Product\ProductList\Toolbar $toolbar
     * @param \Magento\Catalog\Model\ResourceModel\Product\Collection $collection
     */
    protected function vendorConfigureToolbar(
        \Magento\Catalog\Block\Product\ProductList\Toolbar $toolbar,
        \Magento\Catalog\Model\ResourceModel\Product\Collection $collection
    )
    {
        $orders = $this->getAvailableOrders();
        if ($orders) {
            $toolbar->setAvailableOrders($orders);
        }
        $sort = $this->getSortBy();
        if ($sort) {
            $toolbar->setDefaultOrder($sort);
        }
        $dir = $this->getDefaultDirection();
        if ($dir) {
            $toolbar->setDefaultDirection($dir);
        }
        $modes = $this->getModes();
        if ($modes) {
            $toolbar->setModes($modes);
        }
        $toolbar->setCollection($collection);
        $this->setChild('toolbar', $toolbar);
    }
    
}