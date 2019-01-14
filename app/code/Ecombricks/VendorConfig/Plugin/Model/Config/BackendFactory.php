<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorConfig\Plugin\Model\Config;

/**
 * Config backend factory model plugin
 */
class BackendFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{

    /**
     * Around create
     * 
     * @param \Magento\Config\Model\Config\BackendFactory $subject
     * @param \Closure $proceed
     * @param string $modelName
     * @param array $arguments
     * @return \Magento\Framework\App\Config\ValueInterface
     */
    public function aroundCreate(
        \Magento\Config\Model\Config\BackendFactory $subject,
        \Closure $proceed,
        $modelName,
        array $arguments = []
    )
    {
        $object = $proceed($modelName, $arguments);
        $this
            ->setSubject($subject)
            ->setVendorId($object, false);
        return $object;
    }

}