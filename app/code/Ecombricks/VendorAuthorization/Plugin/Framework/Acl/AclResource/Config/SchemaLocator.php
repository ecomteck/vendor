<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorAuthorization\Plugin\Framework\Acl\AclResource\Config;

/**
 * Acl config schema locator plugin
 */
class SchemaLocator
{
    
    /**
     * Around get schema
     * 
     * @param \Magento\Framework\Acl\AclResource\Config\SchemaLocator $subject
     * @param \Closure $proceed
     * @return string
     */
    public function aroundGetSchema(
        \Magento\Framework\Acl\AclResource\Config\SchemaLocator $subject,
        \Closure $proceed
    )
    {
        return $subject->vendorGetSchema();
    }
    
    /**
     * Around get per file schema
     * 
     * @param \Magento\Framework\Acl\AclResource\Config\SchemaLocator $subject
     * @param \Closure $proceed
     * @return string
     */
    public function aroundGetPerFileSchema(
        \Magento\Framework\Acl\AclResource\Config\SchemaLocator $subject,
        \Closure $proceed
    )
    {
        return $subject->vendorGetPerFileSchema();
    }
    
}