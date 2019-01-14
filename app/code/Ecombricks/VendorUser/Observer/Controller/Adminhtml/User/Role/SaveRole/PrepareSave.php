<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorUser\Observer\Controller\Adminhtml\User\Role\SaveRole;

/**
 * User role save controller prepare save observer
 */
class PrepareSave implements \Magento\Framework\Event\ObserverInterface
{
    
    /**
     * Execute
     * 
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $event = $observer->getEvent();
        $userRole = $event->getObject();
        $request = $event->getRequest();
        if (!$userRole || $request) {
            return $this;
        }
        $isVendor = $request->getParam('is_vendor', false);
        $userRole->setIsVendor($isVendor);
        return $this;
    }
    
}