<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Block\Vendor;

/**
 * Vendor list block
 */
class VendorList extends \Ecombricks\Vendor\Block\Vendor\AbstractVendor
{
    
    /**
     * Default toolbar block
     *
     * @var string
     */
    protected $defaultToolbarBlock = \Ecombricks\Vendor\Block\Vendor\VendorList\Toolbar::class;
    
    /**
     * Vendor collection factory
     *
     * @var \Ecombricks\Vendor\Model\ResourceModel\Vendor\CollectionFactory
     */
    protected $vendorCollectionFactory;
    
    /**
     * Vendor collection
     *
     * @var \Ecombricks\Vendor\Model\ResourceModel\Vendor\Collection
     */
    protected $vendorCollection;
    
    /**
     * Logo
     * 
     * @var \Ecombricks\Vendor\Model\Vendor\Logo
     */
    protected $logo;
    
    /**
     * Construct
     * 
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Ecombricks\Vendor\Block\Vendor\ReviewRendererInterface $reviewRenderer
     * @param \Ecombricks\Vendor\Model\ResourceModel\Vendor\CollectionFactory $vendorCollectionFactory
     * @param \Ecombricks\Vendor\Model\Vendor\Logo $logo
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Ecombricks\Vendor\Block\Vendor\ReviewRendererInterface $reviewRenderer,
        \Ecombricks\Vendor\Model\ResourceModel\Vendor\CollectionFactory $vendorCollectionFactory,
        \Ecombricks\Vendor\Model\Vendor\Logo $logo,
        array $data = []
    )
    {
        $this->vendorCollectionFactory = $vendorCollectionFactory;
        $this->logo = $logo;
        parent::__construct($context, $registry, $reviewRenderer, $data);
    }
    
    /**
     * Get logo URL
     * 
     * @param \Ecombricks\Vendor\Model\Vendor $vendor
     * @return string
     */
    public function getLogoUrl($vendor)
    {
        $logo = $vendor->getLogo();
        return ($logo) ? $this->logo->getUrl($logo) : $this->logo->getDefaultUrl();
    }
    
    /**
     * Get logo width
     * 
     * @return int
     */
    public function getLogoWidth()
    {
        return \Ecombricks\Vendor\Model\Vendor\Logo::WIDTH;
    }
    
    /**
     * Get logo height
     * 
     * @return int
     */
    public function getLogoHeight()
    {
        return \Ecombricks\Vendor\Model\Vendor\Logo::WIDTH;
    }
    
    /**
     * Get toolbar block
     *
     * @return \Ecombricks\Vendor\Block\Vendor\VendorList\Toolbar
     */
    protected function getToolbarBlock()
    {
        $layout = $this->getLayout();
        $blockName = $this->getToolbarBlockName();
        if ($blockName) {
            $block = $layout->getBlock($blockName);
            if ($block) {
                return $block;
            }
        }
        $block = $layout->createBlock($this->defaultToolbarBlock, uniqid(microtime()));
        return $block;
    }
    
    /**
     * Configure toolbar
     *
     * @param \Ecombricks\Vendor\Block\Vendor\VendorList\Toolbar $toolbar
     * @param \Ecombricks\Vendor\Model\ResourceModel\Vendor\Collection $collection
     * @return $this
     */
    protected function configureToolbar(
        \Ecombricks\Vendor\Block\Vendor\VendorList\Toolbar $toolbar,
        \Ecombricks\Vendor\Model\ResourceModel\Vendor\Collection $collection
    )
    {
        $orders = $this->getAvailableOrders();
        if (!empty($orders)) {
            $toolbar->setAvailableOrders($orders);
        }
        $order = $this->getDefaultOrder();
        if (!empty($order)) {
            $toolbar->setDefaultOrder($order);
        }
        $direction = $this->getDefaultDirection();
        if (!empty($direction)) {
            $toolbar->setDefaultDirection($direction);
        }
        $toolbar->setVendorCollection($collection);
        $this->setChild('toolbar', $toolbar);
        return $this;
    }
    
    /**
     * Initialize vendor collection
     * 
     * @return \Ecombricks\Vendor\Model\ResourceModel\Vendor\Collection
     */
    protected function initializeVendorCollection()
    {
        $collection = $this->vendorCollectionFactory->create();
        $collection->addFieldToFilter('is_active', 1);
        $this->configureToolbar($this->getToolbarBlock(), $collection);
        $this->_eventManager->dispatch('vendor_block_vendor_list_collection_after_load', [ 'collection' => $collection ]);
        return $collection;
    }
    
    /**
     * Get vendor collection
     * 
     * @return \Ecombricks\Vendor\Model\ResourceModel\Vendor\Collection
     */
    protected function getVendorCollection()
    {
        if ($this->vendorCollection === null) {
            $this->vendorCollection = $this->initializeVendorCollection();
        }
        return $this->vendorCollection;
    }
    
    /**
     * Get loaded vendor collection
     *
     * @return \Ecombricks\Vendor\Model\ResourceModel\Vendor\Collection
     */
    public function getLoadedVendorCollection()
    {
        return $this->getVendorCollection()->load();
    }
    
    /**
     * Get additional HTML
     *
     * @return string
     */
    public function getAdditionalHtml()
    {
        return $this->getChildHtml('additional');
    }
    
    /**
     * Get toolbar HTML
     *
     * @return string
     */
    public function getToolbarHtml()
    {
        return $this->getChildHtml('toolbar');
    }
    
    /**
     * Get identities
     * 
     * @return array
     */
    public function getIdentities()
    {
        $identities = [];
        foreach ($this->getLoadedVendorCollection() as $vendor) {
            $identities = array_merge($identities, $vendor->getIdentities());
        }
        return $identities;
    }
    
}