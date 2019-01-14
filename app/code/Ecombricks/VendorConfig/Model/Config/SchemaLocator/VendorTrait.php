<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorConfig\Model\Config\SchemaLocator;

/**
 * Config schema locator model vendor trait
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
        return $this->vendorUrnResolver->getRealPath('urn:ecombricks:module:Ecombricks_VendorConfig:etc/vendor_system.xsd');
    }
    
    /**
     * Get per file schema
     * 
     * @return string|null
     */
    public function vendorGetPerFileSchema()
    {
        return $this->vendorUrnResolver->getRealPath('urn:ecombricks:module:Ecombricks_VendorConfig:etc/vendor_system_file.xsd');
    }
    
}