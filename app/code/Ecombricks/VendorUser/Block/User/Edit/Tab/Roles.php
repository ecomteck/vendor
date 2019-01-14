<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorUser\Block\User\Edit\Tab;

/**
 * Edit user roles tab
 */
class Roles extends \Magento\User\Block\User\Edit\Tab\Roles 
{
    
    /**
     * Initialize
     * 
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_userRolesFactory->setIsVendor(0);
    }
    
    /**
     * Get selected roles
     * 
     * @param bool $json
     * @return array|string
     */
    public function getSelectedRoles($json = false)
    {
        $request = $this->getRequest();
        $userRoles = $request->getParam('roles', []);
        if (count($userRoles)) {
            return $userRoles;
        }
        return parent::getSelectedRoles($json);
    }
    
}