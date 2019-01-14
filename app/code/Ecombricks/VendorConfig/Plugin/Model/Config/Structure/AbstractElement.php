<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorConfig\Plugin\Model\Config\Structure;

/**
 * Abstract config structure element model plugin
 */
class AbstractElement
{
    
    /**
     * Around is visible
     * 
     * @param \Magento\Config\Model\Config\Structure\AbstractElement $subject
     * @param \Closure $proceed
     * @return string
     */
    public function aroundIsVisible(
        \Magento\Config\Model\Config\Structure\AbstractElement $subject,
        \Closure $proceed
    )
    {
        if ($subject->getVendorId() && !$subject->isEnabledForVendor()) {
            return false;
        }
        if (!$subject->getVendorId() && $subject->isEnabledForVendorOnly()) {
            return false;
        }
        return $proceed();
    }
    
}