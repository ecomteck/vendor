<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorBackend\Block\Vendor;

/**
 * Vendor switcher block
 */
class Switcher extends \Magento\Backend\Block\Template
{
    
    use \Ecombricks\Vendor\Framework\VendorTrait;
    
    /**
     * Template
     *
     * @var string
     */
    protected $_template = 'Ecombricks_VendorBackend::vendor/switcher.phtml';
    
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
        parent::__construct($context, $data);
        $this->vendorManagement = $vendorManagement;
    }
    
    /**
     * Initialize
     * 
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setUseConfirm(true);
        $this->setUseAjax(true);
        $this->setDefaultOptionLabel(__('All Vendors'));
    }
    
    /**
     * Get vendors
     *
     * @return \Ecombricks\Vendor\Model\Vendor[]
     */
    public function getVendors()
    {
        return $this->vendorManagement->getAvailableVendors();
    }
    
    /**
     * Get vendor
     * 
     * @return \Ecombricks\Vendor\Model\Vendor
     */
    public function getVendor()
    {
        return $this->vendorManagement->getVendor($this->getVendorId());
    }
    
    /**
     * Check if default option is available
     * 
     * @return bool
     */
    public function isDefaultOptionAvailable()
    {
        return !$this->vendorManagement->isCurrentUserVendor();
    }
    
    /**
     * Get current option label
     * 
     * @return string
     */
    public function getCurrentOptionLabel()
    {
        $label = $this->getDefaultOptionLabel();
        if ($this->getVendorId()) {
            $vendor = $this->getVendor();
            if ($vendor) {
                $label = $vendor->getName();
            }
        }
        return $label;
    }
    
    /**
     * Get switch URL
     * 
     * @return string
     */
    public function getSwitchUrl()
    {
        $switchUrl = $this->getData('switch_url');
        if ($switchUrl) {
            return $switchUrl;
        }
        return $this->getUrl('*/*/*', ['_current' => true, '_exclude_vendor' => true ]);
    }
    
}