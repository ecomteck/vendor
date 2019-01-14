<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Block\Cart;

/**
 * Cart switcher block
 */
class Switcher extends \Magento\Framework\View\Element\Template
{
    
    /**
     * Vendor ID
     * 
     * @var int
     */
    protected $vendorId;
    
    /**
     * Checkout session
     * 
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;
    
    /**
     * Vendor management
     * 
     * @var \Ecombricks\Vendor\Model\VendorManagement
     */
    protected $vendorManagement;
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Ecombricks\Vendor\Model\VendorManagement $vendorManagement
     * @param array $data
     * @return void
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Ecombricks\Vendor\Model\VendorManagement $vendorManagement,
        array $data = []
    )
    {
        $this->checkoutSession = $checkoutSession;
        $this->vendorManagement = $vendorManagement;
        parent::__construct($context, $data);
    }
    
    /**
     * Set vendor ID
     * 
     * @param int $vendorId
     * @return $this
     */
    public function setVendorId($vendorId)
    {
        $this->vendorId = $vendorId;
        return $this;
    }
    
    /**
     * Get vendor ID
     * 
     * @return int
     */
    public function getVendorId()
    {
        return $this->vendorId;
    }
    
    /**
     * Get vendor IDs
     * 
     * @return array
     */
    protected function getVendorIds()
    {
        return $this->checkoutSession->getVendorIds();
    }
    
    /**
     * Get vendors
     * 
     * @return \Ecombricks\Vendor\Model\Vendor[]
     */
    public function getVendors()
    {
        return $this->vendorManagement->getVendorsByIds($this->getVendorIds());
    }
    
    /**
     * Get current vendor
     * 
     * @return \Ecombricks\Vendor\Model\Vendor
     */
    public function getCurrentVendor()
    {
        return $this->vendorManagement->getVendor($this->getVendorId());
    }
    
    /**
     * Get cart URL
     * 
     * @param int $vendorId
     * @return string
     */
    public function getCartUrl($vendorId)
    {
        return $this->getUrl('checkout/cart/index', [ 'vendor' => $vendorId ]);
    }
    
}