<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorConfig\Plugin\Model\Config;

/**
 * Config factory model plugin
 */
class Factory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Config\Model\Config\Factory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Config\Model\Config
     */
    public function aroundCreate(
        \Magento\Config\Model\Config\Factory $subject,
        \Closure $proceed,
        array $data = []
    )
    {
        $object = $proceed($data);
        $this
            ->setSubject($subject)
            ->setVendorId($object, false);
        return $object;
    }
    
}