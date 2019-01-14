<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Controller\Adminhtml;

/**
 * Vendor controller
 */
abstract class Vendor extends \Magento\Backend\App\Action
{
    
    /**
     * Admin resource
     */
    const ADMIN_RESOURCE = 'Ecombricks_Vendor::vendor';
    
    /**
     * Registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $registry;
    
    /**
     * Vendor factory
     *
     * @var \Ecombricks\Vendor\Model\VendorFactory
     */
    protected $vendorFactory;
    
    /**
     * Constructor
     * 
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Ecombricks\Vendor\Model\VendorFactory $vendorFactory
     * @return void
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $registry,
        \Ecombricks\Vendor\Model\VendorFactory $vendorFactory
    )
    {
        $this->registry = $registry;
        $this->vendorFactory = $vendorFactory;
        parent::__construct($context);
    }

    /**
     * Initialize result page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function initResultPage($resultPage)
    {
        $resultPage
            ->setActiveMenu('Ecombricks_Vendor::vendor')
            ->addBreadcrumb(__('Vendors'), __('Vendors'));
        return $resultPage;
    }
    
}