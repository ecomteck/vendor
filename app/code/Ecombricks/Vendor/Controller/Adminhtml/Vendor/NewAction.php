<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Controller\Adminhtml\Vendor;

/**
 * New vendor controller
 */
class NewAction extends \Ecombricks\Vendor\Controller\Adminhtml\Vendor
{
    
    /**
     * Execute
     * 
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultForward = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_FORWARD);
        return $resultForward->forward('edit');
    }
    
}