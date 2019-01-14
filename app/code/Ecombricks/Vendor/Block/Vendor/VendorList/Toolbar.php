<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Block\Vendor\VendorList;

/**
 * Vendor list toolbar block
 */
class Toolbar extends \Magento\Framework\View\Element\Template
{
    
    /**
     * Template
     * 
     * @var string
     */
    protected $_template = 'Ecombricks_Vendor::vendor/list/toolbar.phtml';
    
    /**
     * Toolbar model
     * 
     * @var \Ecombricks\Vendor\Model\Vendor\VendorList\Toolbar 
     */
    protected $toolbarModel;
    
    /**
     * JSON encoder
     * 
     * @var \Magento\Framework\Json\EncoderInterface
     */
    protected $jsonEncoder;
    
    /**
     * Vendor collection
     *
     * @var \Ecombricks\Vendor\Model\ResourceModel\Vendor\Collection
     */
    protected $vendorCollection;
    
    /**
     * Available limits
     * 
     * @var array
     */
    protected $availableLimits = [ 5 => 5 , 10 => 10, 15 => 15 ];
    
    /**
     * Default limit
     * 
     * @var int
     */
    protected $defaultLimit = 5;
    
    /**
     * Available orders
     * 
     * @var array
     */
    protected $availableOrders;
    
    /**
     * Default order
     *
     * @var string
     */
    protected $defaultOrder = 'name';
    
    /**
     * Default direction
     *
     * @var string
     */
    protected $defaultDirection = 'asc';
    
    /**
     * Pager frame length
     * 
     * @var int 
     */
    protected $pagerFrameLength = 5;
    
    /**
     * Pager jump
     * 
     * @var int 
     */
    protected $pagerJump = 5;
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Ecombricks\Vendor\Model\Vendor\VendorList\Toolbar $toolbarModel
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param array $data
     * @return void
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Ecombricks\Vendor\Model\Vendor\VendorList\Toolbar $toolbarModel,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        array $data = []
    )
    {
        $this->toolbarModel = $toolbarModel;
        $this->jsonEncoder = $jsonEncoder;
        parent::__construct($context, $data);
    }
    
    /**
     * Get vendor collection
     *
     * @return \Ecombricks\Vendor\Model\ResourceModel\Vendor\Collection
     */
    public function getVendorCollection()
    {
        return $this->vendorCollection;
    }
    
    /**
     * Set vendor collection
     * 
     * @param \Ecombricks\Vendor\Model\ResourceModel\Vendor\Collection $vendorCollection
     * @return $this
     */
    public function setVendorCollection($vendorCollection)
    {
        $this->vendorCollection = $vendorCollection;
        $this->vendorCollection->setCurPage($this->getCurrentPage());
        $limit = (int) $this->getCurrentLimit();
        if (!empty($limit)) {
            $this->vendorCollection->setPageSize($limit);
        }
        $order = $this->getCurrentOrder();
        if (!empty($order)) {
            $this->vendorCollection->setOrder($order, $this->getCurrentDirection());
        }
        return $this;
    }
    
    /**
     * Get current page
     *
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->toolbarModel->getCurrentPage();
    }
    
    /**
     * Get available limits
     * 
     * @return array
     */
    public function getAvailableLimits()
    {
        return $this->availableLimits;
    }
    
    /**
     * Get default limit
     *
     * @return string
     */
    public function getDefaultLimit()
    {
        return $this->defaultLimit;
    }
    
    /**
     * Get current limit
     * 
     * @return string
     */
    public function getCurrentLimit()
    {
        $limit = $this->_getData('current_limit');
        if ($limit !== null) {
            return $limit;
        }
        $limits = $this->getAvailableLimits();
        $defaultLimit = $this->getDefaultLimit();
        if (!$defaultLimit || !isset($limits[$defaultLimit])) {
            $keys = array_keys($limits);
            $defaultLimit = $keys[0];
        }
        $limit = $this->toolbarModel->getLimit();
        if (!$limit || !isset($limits[$limit])) {
            $limit = $defaultLimit;
        }
        $this->setData('current_limit', $limit);
        return $limit;
    }
    
    /**
     * Is current limit
     * 
     * @param int $limit
     * @return bool
     */
    public function isCurrentLimit($limit)
    {
        return $limit == $this->getCurrentLimit();
    }
    
    /**
     * Load available orders
     * 
     * @return $this
     */
    protected function loadAvailableOrders()
    {
        if ($this->availableOrders === null) {
            $this->availableOrders = ['name' => __('Name')];
        }
        return $this;
    }
    
    /**
     * Get available orders
     * 
     * @return array
     */
    public function getAvailableOrders()
    {
        $this->loadAvailableOrders();
        return $this->availableOrders;
    }
    
    /**
     * Set available orders
     * 
     * @param array $orders
     * @return $this
     */
    public function setAvailableOrders($orders)
    {
        $this->availableOrders = $orders;
        return $this;
    }
    
    /**
     * Get default order
     * 
     * @return null|string
     */
    protected function getDefaultOrder()
    {
        return $this->defaultOrder;
    }
    
    /**
     * Set default order
     * 
     * @param string $order
     * @return $this
     */
    public function setDefaultOrder($order)
    {
        $this->loadAvailableOrders();
        if (isset($this->availableOrders[$order])) {
            $this->defaultOrder = $order;
        }
        return $this;
    }
    
    /**
     * Get current order
     *
     * @return string
     */
    public function getCurrentOrder()
    {
        $order = $this->_getData('current_order');
        if ($order) {
            return $order;
        }
        $orders = $this->getAvailableOrders();
        $defaultOrder = $this->getDefaultOrder();
        if (!isset($orders[$defaultOrder])) {
            $keys = array_keys($orders);
            $defaultOrder = $keys[0];
        }
        $order = $this->toolbarModel->getOrder();
        if (!$order || !isset($orders[$order])) {
            $order = $defaultOrder;
        }
        $this->setData('current_order', $order);
        return $order;
    }
    
    /**
     * Is current order
     *
     * @param string $order
     * @return bool
     */
    public function isCurrentOrder($order)
    {
        return $order == $this->getCurrentOrder();
    }
    
    /**
     * Get directions
     * 
     * @return array
     */
    protected function getDirections()
    {
        return [ 'asc', 'desc' ];
    }
    
    /**
     * Get default direction
     * 
     * @return string
     */
    public function getDefaultDirection()
    {
        return $this->defaultDirection;
    }
    
    /**
     * Set default direction
     *
     * @param string $dir
     * @return $this
     */
    public function setDefaultDirection($dir)
    {
        if (in_array(strtolower($dir), $this->getDirections())) {
            $this->defaultDirection = strtolower($dir);
        }
        return $this;
    }
    
    /**
     * Get current direction
     *
     * @return string
     */
    public function getCurrentDirection()
    {
        $dir = $this->_getData('current_direction');
        if ($dir) {
            return $dir;
        }
        $dir = strtolower($this->toolbarModel->getDirection());
        if (!$dir || !in_array($dir, $this->getDirections())) {
            $dir = $this->getDefaultDirection();
        }
        $this->setData('current_direction', $dir);
        return $dir;
    }

    /**
     * Get page URL
     *
     * @param array $params
     * @return string
     */
    public function getPagerUrl($params = [])
    {
        $urlParams = [];
        $urlParams['_current'] = true;
        $urlParams['_escape'] = false;
        $urlParams['_use_rewrite'] = true;
        $urlParams['_query'] = $params;
        return $this->getUrl('*/*/*', $urlParams);
    }
    
    /**
     * Get first number
     * 
     * @return int
     */
    public function getFirstNumber()
    {
        $collection = $this->getVendorCollection();
        return $collection->getPageSize() * ($collection->getCurPage() - 1) + 1;
    }
    
    /**
     * Get last number
     * 
     * @return int
     */
    public function getLastNumber()
    {
        $collection = $this->getVendorCollection();
        return $collection->getPageSize() * ($collection->getCurPage() - 1) + $collection->count();
    }
    
    /**
     * Get total number
     * 
     * @return int
     */
    public function getTotalNumber()
    {
        return $this->getVendorCollection()->getSize();
    }
    
    /**
     * Is first page
     * 
     * @return bool
     */
    public function isFirstPage()
    {
        return $this->getVendorCollection()->getCurPage() == 1;
    }
    
    /**
     * Get last page number
     * 
     * @return int
     */
    public function getLastPageNumber()
    {
        return $this->getVendorCollection()->getLastPageNumber();
    }
    
    /**
     * Get pager HTML
     *
     * @return string
     */
    public function getPagerHtml()
    {
        $pagerBlock = $this->getChildBlock('vendor_list_toolbar_pager');
        if (!($pagerBlock instanceof \Magento\Framework\DataObject)) {
            return '';
        }
        $pagerBlock
            ->setAvailableLimit($this->getAvailableLimits())
            ->setUseContainer(false)
            ->setShowPerPage(false)
            ->setShowAmounts(false)
            ->setFrameLength($this->pagerFrameLength)
            ->setJump($this->pagerJump)
            ->setLimit($this->getCurrentLimit())
            ->setCollection($this->getVendorCollection());
        return $pagerBlock->toHtml();
    }
    
    /**
     * Get widget options JSON
     *
     * @param array $customOptions
     * @return string
     */
    public function getWidgetOptionsJson(array $customOptions = [])
    {
        $options = array_replace_recursive([
            'direction' => \Ecombricks\Vendor\Model\Vendor\VendorList\Toolbar::DIRECTION_PARAM_NAME,
            'order' => \Ecombricks\Vendor\Model\Vendor\VendorList\Toolbar::ORDER_PARAM_NAME,
            'limit' => \Ecombricks\Vendor\Model\Vendor\VendorList\Toolbar::LIMIT_PARAM_NAME,
            'directionDefault' => $this->defaultDirection ?: 'asc',
            'orderDefault' => $this->defaultOrder,
            'limitDefault' => $this->defaultLimit,
            'url' => $this->getPagerUrl()
        ], $customOptions);
        return $this->jsonEncoder->encode(['vendorListToolbarForm' => $options]);
    }
    
}