<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Plugin\Model;

/**
 * Checkout composite config provider model plugin
 */
class CompositeConfigProvider
{
    
    /**
     * Around get config
     * 
     * @param \Magento\Checkout\Model\CompositeConfigProvider $subject
     * @param \Closure $proceed
     * @return array
     */
    public function aroundGetConfig(
        \Magento\Checkout\Model\CompositeConfigProvider $subject,
        \Closure $proceed
    )
    {
        $result = $proceed();
        return $subject->vendorAfterGetConfig($result);
    }
    
}