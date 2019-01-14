<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorUser\Block\Role\Tab;

/**
 * Vendor edit user role block
 */
class VendorEdit extends \Magento\User\Block\Role\Tab\Edit
{

    /**
     * Template
     * 
     * @var string
     */
    protected $_template = 'Ecombricks_VendorUser::role/vendor_edit.phtml';

    /**
     * Get ACL resources
     *
     * @return array
     */
    protected function vendorGetAclResources()
    {
        $resources = $this->_aclResourceProvider->getVendorAclResources();
        $configResource = array_filter(
            $resources,
            function ($node) {
                return $node['id'] == 'Magento_Backend::admin';
            }
        );
        $configResource = reset($configResource);
        return isset($configResource['children']) ? $configResource['children'] : [];
    }

    /**
     * Get tree
     *
     * @return array
     */
    public function getTree()
    {
        return $this->_integrationData->mapResources($this->vendorGetAclResources());
    }

}