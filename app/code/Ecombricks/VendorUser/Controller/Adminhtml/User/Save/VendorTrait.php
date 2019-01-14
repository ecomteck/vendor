<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorUser\Controller\Adminhtml\User\Save;

/**
 * Save user controller vendor trait
 */
trait VendorTrait
{
    
    /**
     * Before execute
     * 
     * @return $this
     */
    public function vendorBeforeExecute()
    {
        $request = $this->getRequest();
        $isVendor = $request->getParam('is_vendor', false);
        if ($isVendor) {
            $request->setParam('roles', $request->getParam('vendor_roles'));
        }
        $this->_userFactory->setIsVendor($isVendor);
        return $this;
    }
    
}