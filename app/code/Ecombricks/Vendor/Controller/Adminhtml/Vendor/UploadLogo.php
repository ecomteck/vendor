<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Controller\Adminhtml\Vendor;

/**
 * Upload vendor logo controller
 */
class UploadLogo extends \Ecombricks\Vendor\Controller\Adminhtml\Vendor
{
    
    /**
     * Admin resource
     */
    const ADMIN_RESOURCE = 'Ecombricks_Vendor::vendor';
    
    /**
     * Logo
     * 
     * @var \Ecombricks\Vendor\Model\Vendor\Logo
     */
    protected $logo;
    
    /**
     * Constructor
     * 
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Ecombricks\Vendor\Model\VendorFactory $vendorFactory
     * @param \Ecombricks\Vendor\Model\Vendor\Logo $logo
     * @return void
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $registry,
        \Ecombricks\Vendor\Model\VendorFactory $vendorFactory,
        \Ecombricks\Vendor\Model\Vendor\Logo $logo
    )
    {
        $this->logo = $logo;
        parent::__construct(
            $context,
            $registry,
            $vendorFactory
        );
    }
    
    /**
     * Execute
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try {
            $file = $this->logo->upload();
            $result = $this->logo->getInfo($file);
        } catch (\Exception $exception) {
            $result = ['error' => $exception->getMessage(), 'errorcode' => $exception->getCode()];
        }
        return $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON)->setData($result);
    }
    
}