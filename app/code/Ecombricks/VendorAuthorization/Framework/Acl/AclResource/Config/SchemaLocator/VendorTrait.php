<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorAuthorization\Framework\Acl\AclResource\Config\SchemaLocator;

/**
 * Acl config schema locator vendor trait
 */
trait VendorTrait
{
    
    /**
     * Get schema
     * 
     * @return string|null
     */
    public function vendorGetSchema()
    {
        return $this->vendorUrnResolver->getRealPath('urn:ecombricks:module:Ecombricks_VendorAuthorization:etc/vendor_acl_merged.xsd');
    }
    
    /**
     * Get schema
     * 
     * @return string|null
     */
    public function vendorGetPerFileSchema()
    {
        return $this->vendorUrnResolver->getRealPath('urn:ecombricks:module:Ecombricks_VendorAuthorization:etc/vendor_acl.xsd');
    }
    
}