<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorConfig\Plugin\Model\Config;

/**
 * Config schema locator model plugin
 */
class SchemaLocator
{
    
    /**
     * Around get schema
     * 
     * @param \Magento\Config\Model\Config\SchemaLocator $subject
     * @param \Closure $proceed
     * @return string
     */
    public function aroundGetSchema(
        \Magento\Config\Model\Config\SchemaLocator $subject,
        \Closure $proceed
    )
    {
        return $subject->vendorGetSchema();
    }
    
    /**
     * Around get per file schema
     * @param \Magento\Config\Model\Config\SchemaLocator $subject
     * @param \Closure $proceed
     * @return string
     */
    public function aroundGetPerFileSchema(
        \Magento\Config\Model\Config\SchemaLocator $subject,
        \Closure $proceed
    )
    {
        return $subject->vendorGetPerFileSchema();
    }
    
}