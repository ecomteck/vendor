<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Controller\Vendor;

/**
 * Vendor controller vendor trait
 */
trait VendorTrait
{
    
    /**
     * Registry
     * 
     * @var \Magento\Framework\Registry
     */
    protected $registry;
    
    /**
     * Vendor management
     * 
     * @var \Magento\Framework\Registry
     */
    protected $vendorManagement;
    
    /**
     * Initialize
     *
     * @return \Ecombricks\Vendor\Model\Vendor
     */
    public function vendorInit()
    {
        $code = $this->getRequest()->getParam('code', false);
        if (!$code) {
            return false;
        }
        $vendor = $this->vendorManagement->getVendorByCode(strtolower($code));
        if (!$vendor || !$vendor->isActive()) {
            return false;
        }
        $this->setVendorId($vendor->getId());
        $this->registry->register('vendor', $vendor);
        return $vendor;
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
     * Set page title
     * 
     * @param \Magento\Framework\Controller\ResultInterface $pageResult
     * @param string $title
     * @return $this
     */
    protected function setPageTitle(\Magento\Framework\Controller\ResultInterface $pageResult, $title)
    {
        $pageResult
            ->getConfig()
            ->getTitle()
            ->set($title);
        $titleBlock = $this->_view
            ->getLayout()
            ->getBlock('page.main.title');
        if (empty($titleBlock)) {
            return $this;
        }
        $titleBlock->setPageTitle($titleBlock->escapeHtml($title));
        return $this;
    }

}