<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Controller\Vendor;

/**
 * Vendor index controller
 */
class Index extends \Magento\Framework\App\Action\Action
{
    
    /**
     * Execute
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $pageResult = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        $pageConfig = $pageResult->getConfig();
        $pageConfig->getTitle()->set(__('Vendors'));
        $pageConfig->addBodyClass('page-vendors');
        return $pageResult;
    }
    
}