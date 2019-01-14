<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorAuthorization\Plugin\Framework\Acl\AclResource\Config\Converter;

/**
 * Acl config convertor plugin
 */
class Dom
{
    
    /**
     * Around convert
     * 
     * @param \Magento\Framework\Acl\AclResource\Config\Converter\Dom $subject
     * @param \Closure $proceed
     * @param \DOMDocument $source
     * @return array
     */
    public function aroundConvert(
        \Magento\Framework\Acl\AclResource\Config\Converter\Dom $subject,
        \Closure $proceed,
        $source
    )
    {
        return $subject->vendorConvert($source);
    }
    
}