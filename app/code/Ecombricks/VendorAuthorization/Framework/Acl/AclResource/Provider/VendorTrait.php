<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorAuthorization\Framework\Acl\AclResource\Provider;

/**
 * ACL resource provider vendor trait
 */
trait VendorTrait
{
    
    /**
     * Get vendor ACL resources
     * 
     * @return array
     */
    public function getVendorAclResources()
    {
        $tree = $this->vendorAclDataCache->load($this->vendorAclDataCacheKey);
        if ($tree) {
            return $this->vendorSerializer->unserialize($tree);
        }
        $aclResourceConfig = $this->_configReader->read();
        if (!empty($aclResourceConfig['config']['acl']['resources'])) {
            $tree = $this->vendorResourceTreeBuilder->build($aclResourceConfig['config']['acl']['resources']);
            $this->vendorAclDataCache->save($this->vendorSerializer->serialize($tree), $this->vendorAclDataCacheKey);
            return $tree;
        }
        return [];
    }
    
}