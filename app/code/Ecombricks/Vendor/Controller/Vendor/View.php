<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Controller\Vendor;

/**
 * View vendor controller
 */
class View extends \Ecombricks\Vendor\Controller\Vendor\AbstractVendor
{
    
    /**
     * Execute
     * 
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $vendor = $this->getVendor();
        $pageResult = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        $this->setPageTitle($pageResult, ($vendor->getMetaTitle()) ? $vendor->getMetaTitle() : $vendor->getName());
        $pageConfig = $pageResult->getConfig();
        $pageConfig->setKeywords($vendor->getMetaKeywords());
        $pageConfig->setDescription($vendor->getMetaDescription());
        return $pageResult;
    }
    
}