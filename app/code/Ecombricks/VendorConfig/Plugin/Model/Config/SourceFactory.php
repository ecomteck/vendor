<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorConfig\Plugin\Model\Config;

/**
 * Config source factory model plugin
 */
class SourceFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Config\Model\Config\SourceFactory $subject
     * @param \Closure $proceed
     * @param string $modelName
     * @return \Magento\Framework\Option\ArrayInterface
     */
    public function aroundCreate(
        \Magento\Config\Model\Config\SourceFactory $subject,
        \Closure $proceed,
        $modelName
    )
    {
        $object = $proceed($modelName);
        $this
            ->setSubject($subject)
            ->setVendorId($object, false);
        return $object;
    }
    
}