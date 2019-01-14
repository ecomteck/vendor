<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Controller\Vendor;

/**
 * Abstract vendor controller
 */
abstract class AbstractVendor extends \Magento\Framework\App\Action\Action
{
    
    use \Ecombricks\Vendor\Controller\Vendor\VendorTrait;
    
    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Ecombricks\Vendor\Model\VendorManagement $vendorManagement
     * @return void
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Registry $registry,
        \Ecombricks\Vendor\Model\VendorManagement $vendorManagement
    )
    {
        parent::__construct($context);
        $this->registry = $registry;
        $this->vendorManagement = $vendorManagement;
    }
    
    /**
     * Dispatch
     *
     * @param \Magento\Framework\App\RequestInterface $request
     * @return \Magento\Framework\App\ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $vendor = $this->vendorInit();
        if (!$vendor) {
            throw new \Magento\Framework\Exception\NotFoundException(__('Vendor not found.'));
        }
        return parent::dispatch($request);
    }
    
}