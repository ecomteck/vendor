<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Controller\Adminhtml\Vendor;

/**
 * Vendor index controller
 */
class Index extends \Ecombricks\Vendor\Controller\Adminhtml\Vendor
{
    
    /**
     * Execute
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        $this->initResultPage($resultPage)->getConfig()->getTitle()->prepend(__('Vendors'));
        return $resultPage;
    }
    
}