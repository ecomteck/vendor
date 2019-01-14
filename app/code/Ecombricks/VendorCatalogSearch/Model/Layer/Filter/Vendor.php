<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCatalogSearch\Model\Layer\Filter;

/**
 * Layer vendor filter
 */
class Vendor extends \Magento\Catalog\Model\Layer\Filter\AbstractFilter
{
    
    /**
     * Escaper
     *
     * @var \Magento\Framework\Escaper
     */
    protected $escaper;
    
    /**
     * Vendor management
     * 
     * @var \Ecombricks\Vendor\Model\VendorManagement
     */
    protected $vendorManagement;
    
    /**
     * Constructor
     *
     * @param \Magento\Catalog\Model\Layer\Filter\ItemFactory $filterItemFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Catalog\Model\Layer $layer
     * @param \Magento\Catalog\Model\Layer\Filter\Item\DataBuilder $itemDataBuilder
     * @param \Magento\Framework\Escaper $escaper
     * @param array $data
     * @return void
     */
    public function __construct(
        \Magento\Catalog\Model\Layer\Filter\ItemFactory $filterItemFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\Layer $layer,
        \Magento\Catalog\Model\Layer\Filter\Item\DataBuilder $itemDataBuilder,
        \Magento\Framework\Escaper $escaper,
        \Ecombricks\Vendor\Model\VendorManagement $vendorManagement,
        array $data = []
    )
    {
        parent::__construct($filterItemFactory, $storeManager, $layer, $itemDataBuilder, $data);
        $this->_requestVar = 'vendor';
        $this->escaper = $escaper;
        $this->vendorManagement = $vendorManagement;
    }

    /**
     * Apply
     *
     * @param \Magento\Framework\App\RequestInterface $request
     * @return $this
     */
    public function apply(\Magento\Framework\App\RequestInterface $request)
    {
        $requestVendorId = $request->getParam($this->getRequestVar());
        if ($requestVendorId === null) {
            return $this;
        }
        $vendorId = (int) $requestVendorId;
        $vendor = $this->vendorManagement->getVendor($vendorId);
        if ($vendor) {
            $layer = $this->getLayer();
            $layer->getProductCollection()->addVendorFilter($vendorId);
            $layer->getState()->addFilter($this->_createItem($vendor->getName(), $vendorId));
        }
        return $this;
    }
    
    /**
     * Get name
     * 
     * @return \Magento\Framework\Phrase
     */
    public function getName()
    {
        return __('Vendor');
    }

    /**
     * Get items data
     *
     * @return array
     */
    protected function _getItemsData()
    {
        $vendors = $this->vendorManagement->getAvailableVendors();
        $productCollection = $this->getLayer()->getProductCollection();
        $optionsFacetedData = $productCollection->getFacetedData('vendor');
        $collectionSize = $productCollection->getSize();
        foreach ($vendors as $vendor) {
            $vendorId = (int) $vendor->getId();
            if (
                isset($optionsFacetedData[$vendorId]) && 
                $this->isOptionReducesResults($optionsFacetedData[$vendorId]['count'], $collectionSize)
            ) {
                $this->itemDataBuilder->addItemData(
                    $this->escaper->escapeHtml($vendor->getName()),
                    $vendorId,
                    $optionsFacetedData[$vendorId]['count']
                );
            }
        }
        return $this->itemDataBuilder->build();
    }
    
}