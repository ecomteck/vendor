<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCatalog\Controller\Vendor;

/**
 * Vendor products controller
 */
class Products extends \Ecombricks\Vendor\Controller\Vendor\AbstractVendor
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
        $this->setPageTitle($pageResult, __('%1 Products', $vendor->getName()));
        return $pageResult;
    }
    
}