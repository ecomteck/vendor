<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorUser\Observer\Block\Backend\Template;

/**
 * Backend template before html block observer
 */
class BeforeHtml implements \Magento\Framework\Event\ObserverInterface
{
    
    /**
     * Registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $registry;
    
    /**
     * Vendor management
     * 
     * @var \Ecombricks\Vendor\Model\VendorManagement
     */
    protected $vendorManagement;
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\Registry $registry
     * @param \Ecombricks\Vendor\Model\VendorManagement $vendorManagement
     * @return void
     */
    public function __construct(
        \Magento\Framework\Registry $registry,
        \Ecombricks\Vendor\Model\VendorManagement $vendorManagement
    )
    {
        $this->registry = $registry;
        $this->vendorManagement = $vendorManagement;
    }
    
    /**
     * Get bool options
     * 
     * @return array
     */
    protected function getBooleanOptions()
    {
        return [
            ['label' => __('Yes'), 'value' => 1],
            ['label' => __('No'), 'value' => 0]
        ];
    }
    
    /**
     * JSON encode
     * 
     * @param mixed $data
     * @param bool $cycleCheck
     * @param array $options
     * @return string
     */
    protected function jsonEncode($data, $cycleCheck = false, $options = [])
    {
        return \Zend_Json::encode($data, $cycleCheck, $options);
    }

    /**
     * Modify user role info tab block
     * 
     * @param \Magento\User\Block\Role\Tab\Info $block
     * @return $this
     */
    protected function modifyUserRoleInfoTabBlock($block)
    {
        $form = $block->getForm();
        if (!$form) {
            return $this;
        }
        $baseFieldset = $form->getElement('base_fieldset');
        if (!$baseFieldset) {
            return $this;
        }
        $userRole = $block->getRole();
        $baseFieldset
            ->addField(
                'is_vendor',
                'select',
                [
                    'name' => 'is_vendor',
                    'label' => __('Vendor Role'),
                    'values' => $this->getBooleanOptions(),
                    'value' => ($userRole) ? $userRole->getIsVendor() : 0,
                ]
            )
            ->addCustomAttribute('data-mage-init', $block->escapeHtml($this->jsonEncode([
                'userRoleVendorFlagSwitcher' => [
                    'resourcesTabId' => 'role_info_tabs_account',
                    'vendorResourcesTabId' => 'role_info_tabs_vendor_edit'
                ]
            ])));
        return $this;
    }
    
    /**
     * Modify user main tab block
     * 
     * @param \Magento\User\Block\User\Edit\Tab\Main $block
     * @return $this
     */
    protected function modifyUserMainTabBlock($block)
    {
        $form = $block->getForm();
        if (!$form) {
            return $this;
        }
        $baseFieldset = $form->getElement('base_fieldset');
        if (!$baseFieldset) {
            return $this;
        }
        $user = $this->registry->registry('permissions_user');
        $baseFieldset
            ->addField(
                'is_vendor',
                'select',
                [
                    'name' => 'is_vendor',
                    'label' => __('Vendor User'),
                    'values' => $this->getBooleanOptions(),
                    'value' => ($user) ? $user->getIsVendor() : 0,
                ]
            )
            ->addCustomAttribute('data-mage-init', $block->escapeHtml($this->jsonEncode([
                'userVendorFlagSwitcher' => [
                    'userRolesTabId' => 'page_tabs_roles_section',
                    'vendorUserRolesTabId' => 'page_tabs_vendor_roles_section',
                    'vendorSelectorId' => 'user_vendor_ids',
                ]
            ])));
        $baseFieldset->addField(
            'vendor_ids',
            'multiselect',
            [
                'name' => 'vendor_ids',
                'label' => __('Vendors'),
                'values' => $this->vendorManagement->getAvailableVendorOptions(false),
                'value' => ($user) ? $user->getVendorIds() : [],
            ]
        );
        return $this;
    }
    
    /**
     * Modify edit user role tabs block
     * 
     * @param \Magento\User\Block\Role\Edit $block
     * @return $this
     */
    protected function modifyEditUserRoleTabs($block)
    {
        $layout = $block->getLayout();
        $layout->unsetElement('role.users.grid');
        $block->removeTab('roles');
        $block->vendorAssignTabs();
        return $this;
    }
    
    /**
     * Modify edit user tabs block
     * 
     * @param \Magento\User\Block\User\Edit\Tabs $block
     * @return $this
     */
    protected function modifyEditUserTabsBlock($block)
    {
        $layout = $block->getLayout();
        $layout->unsetElement('user.roles.grid');
        $block->removeTab('roles_section');
        $block->addTab(
            'roles_section',
            [
                'label' => __('User Role'),
                'title' => __('User Role'),
                'content' => $layout->createBlock(\Ecombricks\VendorUser\Block\User\Edit\Tab\Roles::class, 'user.roles.grid')->toHtml()
            ]
        );
        $block->addTab(
            'vendor_roles_section',
            [
                'label' => __('User Role'),
                'title' => __('User Role'),
                'content' => $layout->createBlock(\Ecombricks\VendorUser\Block\User\Edit\Tab\VendorRoles::class, 'user.vendor.roles.grid')->toHtml()
            ]
        );
        $block->vendorAssignTabs();
        return $this;
    }
    
    /**
     * Execute
     * 
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $block = $observer->getEvent()->getBlock();
        if (!$block) {
            return $this;
        }
        if ($block instanceof \Magento\User\Block\Role\Tab\Info) {
            $this->modifyUserRoleInfoTabBlock($block);
        } else if ($block instanceof \Magento\User\Block\User\Edit\Tab\Main) {
            $this->modifyUserMainTabBlock($block);
        } else if ($block instanceof \Magento\User\Block\Role\Edit) {
            $this->modifyEditUserRoleTabs($block);
        } else if ($block instanceof \Magento\User\Block\User\Edit\Tabs) {
            $this->modifyEditUserTabsBlock($block);
        }
        return $this;
    }

}