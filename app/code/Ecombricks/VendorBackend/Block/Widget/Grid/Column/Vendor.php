<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorBackend\Block\Widget\Grid\Column;

/**
 * Vendor grid column
 */
class Vendor extends \Magento\Backend\Block\Widget\Grid\Column
{
    
    /**
     * Vendor management
     * 
     * @var \Ecombricks\Vendor\Model\VendorManagement
     */
    protected $vendorManagement;
    
    /**
     * Constructor
     * 
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Ecombricks\Vendor\Model\VendorManagement $vendorManagement
     * @param array $data
     * @return void
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Ecombricks\Vendor\Model\VendorManagement $vendorManagement,
        array $data = []
    )
    {
        $this->vendorManagement = $vendorManagement;
        parent::__construct($context, $data);
    }
    
    /**
     * Initialize
     * 
     * @return void
     */
    public function _construct()
    {
        parent::_construct();
        $this->setData('header', __('Vendor'));
        $this->setData('index', 'vendor_id');
        $this->setData('renderer', $this->_rendererTypes['options']);
        $this->setData('filter', $this->_filterTypes['options']);
        $this->setData('options', $this->vendorManagement->getAvailableVendorOptions(false));
    }
    
}