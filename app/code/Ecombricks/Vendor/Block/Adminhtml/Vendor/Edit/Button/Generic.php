<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Block\Adminhtml\Vendor\Edit\Button;

/**
 * Generic vendor button
 */
class Generic implements \Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface
{
    
    /**
     * UI component context
     * 
     * @var \Magento\Framework\View\Element\UiComponent\Context
     */
    protected $context;
    
    /**
     * Registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $registry;
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\View\Element\UiComponent\Context $context
     * @param \Magento\Framework\Registry $registry
     * @return void
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\Context $context,
        \Magento\Framework\Registry $registry
    )
    {
        $this->context = $context;
        $this->registry = $registry;
    }
    
    /**
     * Get URL
     *
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrl($route, $params);
    }
    
    /**
     * Get vendor
     * 
     * @return \Ecombricks\Vendor\Model\Vendor
     */
    public function getVendor()
    {
        return $this->registry->registry('vendor');
    }
    
    /**
     * Get vendor ID
     * 
     * @return int|null
     */
    public function getVendorId()
    {
        return $this->getVendor()->getId();
    }
    
    /**
     * Get button data
     * 
     * @return array
     */
    public function getButtonData()
    {
        return [];
    }
    
}