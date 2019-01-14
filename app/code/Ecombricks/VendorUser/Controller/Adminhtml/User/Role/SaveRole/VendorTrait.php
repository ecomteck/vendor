<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorUser\Controller\Adminhtml\User\Role\SaveRole;

/**
 * Save user role controller vendor trait
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
        if (!$isVendor) {
            $isAll = $request->getParam('all');
            if ($isAll) {
                $resource = [ $this->vendorRootAclResource->getId() ];
            } else {
                $resource = $request->getParam('resource', false);
            }
        } else {
            $resource = $request->getParam('vendor_resource', false);
        }
        $request->setParam('resource', $resource);
        $this->_roleFactory->setIsVendor($isVendor);
        return $this;
    }
    
}