<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorUser\Block\User\Edit\Tab;

/**
 * Edit user vendor roles tab
 */
class VendorRoles extends \Ecombricks\VendorUser\Block\User\Edit\Tab\Roles
{
    
    /**
     * Initialize
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('permissionsUserVendorRolesGrid');
        $this->_userRolesFactory->setIsVendor(1);
    }
    
    /**
     * @return $this
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'assigned_user_role',
            [
                'header_css_class' => 'data-grid-actions-cell',
                'header' => __('Assigned'),
                'type' => 'radio',
                'html_name' => 'vendor_roles[]',
                'values' => $this->getSelectedRoles(),
                'align' => 'center',
                'index' => 'role_id'
            ]
        );
        $this->addColumn(
            'role_name',
            [
                'header' => __('Role'),
                'index' => 'role_name'
            ]
        );
        return \Magento\Backend\Block\Widget\Grid\Extended::_prepareColumns();
    }
    
    
    /**
     * @return string
     */
    public function getGridUrl()
    {
        $user = $this->_coreRegistry->registry('permissions_user');
        return $this->getUrl('vendor_user/user/rolesGrid', ['user_id' => $user->getUserId()]);
    }
    
}