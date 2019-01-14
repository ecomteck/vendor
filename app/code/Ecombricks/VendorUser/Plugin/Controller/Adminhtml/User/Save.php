<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorUser\Plugin\Controller\Adminhtml\User;

/**
 * Save user controller plugin
 */
class Save
{
    
    /**
     * Around execute
     * 
     * @param \Magento\User\Controller\Adminhtml\User\Save $subject
     * @param \Closure $proceed
     * @return \Magento\User\Controller\Adminhtml\User\Save
     */
    public function aroundExecute(
        \Magento\User\Controller\Adminhtml\User\Save $subject,
        \Closure $proceed
    )
    {
        $subject->vendorBeforeExecute();
        return $proceed();
    }
    
}