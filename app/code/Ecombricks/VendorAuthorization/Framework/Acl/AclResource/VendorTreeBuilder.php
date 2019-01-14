<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorAuthorization\Framework\Acl\AclResource;

/**
 * Vendor ACL resource tree builder
 */
class VendorTreeBuilder extends \Magento\Framework\Acl\AclResource\TreeBuilder
{
    
    /**
     * Build
     * 
     * @param array $resourceList
     * @return array
     */
    public function build(array $resourceList)
    {
        $result = [];
        foreach ($resourceList as $resource) {
            if ($resource['disabled'] || !$resource['enabledForVendor']) {
                continue;
            }
            unset($resource['disabled']);
            $resource['children'] = $this->build($resource['children']);
            $result[] = $resource;
        }
        usort($result, [$this, '_sortTree']);
        return $result;
    }
    
}