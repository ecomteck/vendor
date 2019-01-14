<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorUser\Plugin\Controller\Adminhtml\User\Role;

/**
 * Save user role controller plugin
 */
class SaveRole
{
    
    /**
     * Around execute
     * 
     * @param \Magento\User\Controller\Adminhtml\User\Role\SaveRole $subject
     * @param \Closure $proceed
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function aroundExecute(
        \Magento\User\Controller\Adminhtml\User\Role\SaveRole $subject,
        \Closure $proceed
    )
    {
        $subject->vendorBeforeExecute();
        return $proceed();
    }
    
}