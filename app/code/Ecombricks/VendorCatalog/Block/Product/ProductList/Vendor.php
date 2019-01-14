<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCatalog\Block\Product\ProductList;

/**
 * Product vendor products
 */
class Vendor extends \Magento\Catalog\Block\Product\AbstractProduct 
    implements \Magento\Framework\DataObject\IdentityInterface
{
    
    /**
     * Product collection factory
     *
     * @var \Magento\Catalog\Model\ResourceModel\Product\Link\Product\CollectionFactory
     */
    protected $productCollectionFactory;
    
    /**
     * Item collection
     * 
     * @var \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    protected $itemCollection;
    
    /**
     * Catalog product visibility
     *
     * @var \Magento\Catalog\Model\Product\Visibility
     */
    protected $catalogProductVisibility;
    
    /**
     * Module manager
     * 
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;
    
    /**
     * Constructor
     * 
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \Magento\Catalog\Model\ResourceModel\Product\Link\Product\CollectionFactory $productCollectionFactory
     * @param \Magento\Catalog\Model\Product\Visibility $catalogProductVisibility
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     * @return void
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\Link\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\Product\Visibility $catalogProductVisibility,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    )
    {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->catalogProductVisibility = $catalogProductVisibility;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $data);
    }

    /**
     * Prepare data
     * 
     * @return $this
     */
    protected function _prepareData()
    {
        $product = $this->_coreRegistry->registry('product');
        $vendorId = $product->getVendorId();
        if (!$vendorId) {
            return $this;
        }
        $productCollection = $this->productCollectionFactory->create()
            ->addAttributeToSelect('required_options')
            ->addStoreFilter($product->getStore())
            ->addVendorFilter($vendorId);
        $select = $productCollection->getSelect();
        $select->where('e.entity_id <> ?', $product->getId());
        $select->limit(12);
        if ($this->moduleManager->isEnabled('Magento_Checkout')) {
            $this->_addProductAttributesAndPrices($productCollection);
        }
        $productCollection->setVisibility($this->catalogProductVisibility->getVisibleInCatalogIds());
        $productCollection->load();
        foreach ($productCollection as $product) {
            $product->setDoNotUseCategoryId(true);
        }
        $this->itemCollection = $productCollection;
        return $this;
    }

    /**
     * Before to HTML
     * 
     * @return $this
     */
    protected function _beforeToHtml()
    {
        $this->_prepareData();
        return parent::_beforeToHtml();
    }

    /**
     * Get item collection
     * 
     * @return Collection
     */
    public function getItems()
    {
        return $this->itemCollection;
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        $identities = [];
        foreach ($this->getItems() as $item) {
            $identities = array_merge($identities, $item->getIdentities());
        }
        return $identities;
    }
    
}